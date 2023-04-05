<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\QuestionAnswerImport;
use App\Models\Admin;
use App\Models\AnswerdQuestion;
use App\Models\Category;
use App\Models\ExamControl;
use App\Models\QuestionAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class QuestionAnswerController extends Controller
{
    public function index()
    {
        $QA = QuestionAnswer::where(['status'=>1,'is_archive'=>0])->get();
        $category = Category::where(['status'=>1,'is_archive'=>0])->get();
        return view('admin.pages.questions.index', [
            'question' => $QA,
            'category' => $category,
            'form_type' => 'create',
        ]);
    }
    public function result()
    {
        $result = Admin::where('id', Auth::guard('admin')->user()->id)->get();
        return view('admin.pages.result.index', [
            'result' => $result,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
//            'question' => 'required',
            'option' => 'required',
            'answer' => 'required'
        ]);
        if(empty($request->question) && empty($request->image_question)){
            return back()->with('error', 'Please Add Question First');
        }

        $question = new QuestionAnswer();
        $question->category_id = $request->category_id;
        $question->question = $request->question;
        $question->option =  json_encode($request->option);
        $question->answer = $request->answer;
        if ($request->hasFile('image_question')) {
            $img = $request->file('image_question');
            $question_image = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $filePath = "app/public/question";
            if (!file_exists(storage_path($filePath))) {
                mkdir(storage_path($filePath),666,true);
            }

            $inter->save(storage_path('app/public/question/') . $question_image);
        }
        $question->image_question = $question_image;
        $question->status = 1;

        $question->save();
        return back()->with('success', 'Question added successfully');
    }
    public function edit($id)
    {
        $QA = QuestionAnswer::get();
        $qno = QuestionAnswer::findOrFail($id);
        $category = Category::where(['status'=>1,'is_archive'=>0])->get();
        return view('admin.pages.questions.index', [
            'question' => $QA,
            'edit'  => $qno,
            'category' => $category,
            'form_type' => 'edit',
        ]);
    }
    public function update(Request $request, $id)
    {
        $update_data = QuestionAnswer::findOrFail($id);
        if ($request->hasFile('new_image_question')) {
            $img = $request->file('new_image_question');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/question/') . $file_name);
        } else {
            $file_name = $request->image_question;
        }
        $update_data->update([
            'question' => $request->question,
            'option' => json_encode($request->option),
            'answer' => $request->answer,
            'category_id' => $request->category_id,
            'image_question' => $file_name,
        ]);
        return back()->with('success', 'Question updated successfully');
    }
    public function round1()
    {
        if (Auth::guard('admin')->user()->round_one_status == 1) {
            return redirect()->route('home.page')->with('danger-front', 'You can participate exam only one time.');
        }
       Admin::where('id', Auth::guard('admin')->user()->id)->update(['round_one_status' => true]);
        $ExamTime = ExamControl::first();
//        $QA = QuestionAnswer::inRandomOrder()->limit($ExamTime->question_qty)->get();

        $categoryList = Category::where(['status'=>1,'is_archive'=>0])->get();

        $newArr = [];
        foreach ($categoryList as $catgory){
            $newArr[$catgory->id] = QuestionAnswer::where(['category_id'=>$catgory->id,'status'=>1,'is_archive'=>0])->inRandomOrder()->limit($catgory->question_size)->get()->toArray();
        }

        $QA = array_merge(...array_values($newArr));
        $minute = !empty($ExamTime->minutes) ? $ExamTime->minutes : 0;
        $seconds = !empty($ExamTime->seconds) ? $ExamTime->seconds : 20;
        return view('admin.pages.questions.round1', [
            'question' => $QA,'minute'=>$minute,'seconds'=>$seconds
        ]);
    }
    public function round1store(Request $request)
    {
        $resultCounter = 0;
        try {
            DB::beginTransaction();
            if (!empty($request->question) &&
                count($request->question) > 0 &&
                !empty($request->answer) &&
                count($request->answer) > 0)
            {
                foreach ($request->question as $key => $value) {

                    $mainResult = QuestionAnswer::find($value)->answer;
                    if (!empty($mainResult) && !empty($request->answer[$key]) && $mainResult == $request->answer[$key]) {
                        $resultCounter++;
                    }

                    $answerdQuestion = new AnswerdQuestion();
                    $answerdQuestion->user_id = Auth::guard('admin')->user()->id;
                    $answerdQuestion->question_id = $value;
                    $answerdQuestion->category_id = isset($request->category_id[$key]) ? $request->category_id[$key] : '';
                    $answerdQuestion->answer = isset($request->answer[$key]) ? $request->answer[$key] : '';
                    $answerdQuestion->created_at = Carbon::now();
                    $answerdQuestion->save();
                }
            }

            Admin::where('id', Auth::guard('admin')->user()->id)
                ->update(['round_one_result' => $resultCounter,'duration' => $request->duration]);

            DB::commit();
            return redirect()->route('result.index')->with('success-main', 'Answer Script successfully Submitted');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Answer Script Failed To Submitted Message : '.$e->getMessage().' File '.$e->getFile().' Line'. $e->getLine());
            return  redirect()->route('home.page')->with('danger-main', 'Answer Script Failed To Submitted');;
        }
    }

    public function importQuestionFromExcel(Request $request)
    {
        try{
            Excel::import(new QuestionAnswerImport, request()->file('question_excel_file'));

            return redirect('/add-question')->with('success-main', 'All good!');

        }catch (\Exception $e){
            Log::error('Excel Data Save Error: '.$e->getMessage().' File: '.$e->getFile().' Line: '.$e->getLine());
            return redirect('/add-question')->with('danger-main', 'something is wrong');
        }

    }
}
