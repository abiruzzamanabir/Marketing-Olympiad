<?php

namespace App\Http\Controllers\Admin;

use App\Models\CategoryTwo;
use Illuminate\Http\Request;
use App\Models\QuestionAnswerTwo;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use App\Imports\QuestionAnswerImportTwo;
use App\Models\Admin;
use App\Models\AnswerdQuestionTwo;
use App\Models\ExamControl;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionAnswerControllerTwo extends Controller
{
    public function index()
    {
        $QA = QuestionAnswerTwo::where(['status' => 1, 'is_archive' => 0])->get();
        $category = CategoryTwo::where(['status' => 1, 'is_archive' => 0])->get();
        return view('admin.pages.questionsRoundTwo.index', [
            'question' => $QA,
            'category' => $category,
            'form_type' => 'create',

        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            //            'question' => 'required',
            'option' => 'required',
            'answer' => 'required'
        ]);
        if (empty($request->question) && empty($request->image_question)) {
            return back()->with('error', 'Please Add Question First');
        }

        $question = new QuestionAnswerTwo();
        $question->category_id = $request->category_id;
        $question->question = $request->question;
        $question->option =  json_encode($request->option);
        $question->answer = $request->answer;
        if ($request->hasFile('image_question')) {
            $img = $request->file('image_question');
            $question_image = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $filePath = "app/public/questionTwo";
            if (!file_exists(storage_path($filePath))) {
                mkdir(storage_path($filePath), 666, true);
            }

            $inter->save(storage_path('app/public/questionTwo/') . $question_image);
            $question->image_question = $question_image;
        }
        $question->status = 1;

        $question->save();
        return back()->with('success', 'Question added successfully');
    }
    public function edit($id)
    {
        $QA = QuestionAnswerTwo::get();
        $qno = QuestionAnswerTwo::findOrFail($id);
        $category = CategoryTwo::where(['status' => 1, 'is_archive' => 0])->get();
        return view('admin.pages.questionsRoundTwo.index', [
            'question' => $QA,
            'edit'  => $qno,
            'category' => $category,
            'form_type' => 'edit',
        ]);
    }
    public function update(Request $request, $id)
    {
        $update_data = QuestionAnswerTwo::findOrFail($id);
        if ($request->hasFile('new_image_question')) {
            $img = $request->file('new_image_question');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/questionTwo/') . $file_name);
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
    public function importQuestionFromExcelTwo(Request $request)
    {
        try {
            Excel::import(new QuestionAnswerImportTwo, request()->file('question_excel_file'));

            return redirect('/add-question-round-2')->with('success-main', 'Question Uploaded Successfully!');
        } catch (\Exception $e) {
            Log::error('Excel Data Save Error: ' . $e->getMessage() . ' File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            return redirect('/add-question-round-2')->with('danger-main', 'Something Is Wrong.Please Check Log File');
        }
    }
    public function round2()
    {
        if (Auth::guard('admin')->user()->round_two_status == 1) {
            return redirect()->route('home.page')->with('danger-front', 'You can participate exam only one time.');
        }
        Admin::where('id', Auth::guard('admin')->user()->id)->update(['round_two_status' => true]);
//        Admin::where('id', Auth::guard('admin')->user()->id)->update(['round_one_status' => true]);
        $ExamTime = ExamControl::first();
        //        $QA = QuestionAnswer::inRandomOrder()->limit($ExamTime->question_qty)->get();

        $categoryList = CategoryTwo::where(['status' => 1, 'is_archive' => 0])->get();

        $newArr = [];
        foreach ($categoryList as $catgory) {
            $newArr[$catgory->id] = QuestionAnswerTwo::where(['category_id' => $catgory->id, 'status' => 1, 'is_archive' => 0])->inRandomOrder()->limit($catgory->question_size)->get()->toArray();
        }
        $QA = array_merge(...array_values($newArr));
        $minute = !empty($ExamTime->minutes) ? $ExamTime->minutes : 0;
        $seconds = !empty($ExamTime->seconds) ? $ExamTime->seconds : 20;
        return view('admin.pages.questionsRoundTwo.round2', [
            'question' => $QA, 'minute' => $minute, 'seconds' => $seconds
        ]);
    }
    public function round2store(Request $request)
    {
        $resultCounter = 0;
        try {
            DB::beginTransaction();
            if (
                !empty($request->question) &&
                count($request->question) > 0 &&
                !empty($request->answer) &&
                count($request->answer) > 0
            ) {
                foreach ($request->question as $key => $value) {

                    $mainResult = QuestionAnswerTwo::find($value)->answer;
                    if (!empty($mainResult) && !empty($request->answer[$key]) && $mainResult == $request->answer[$key]) {
                        $resultCounter++;
                    }

                    $answerdQuestion = new AnswerdQuestionTwo();
                    $answerdQuestion->user_id = Auth::guard('admin')->user()->id;
                    $answerdQuestion->question_id = $value;
                    $answerdQuestion->category_id = isset($request->category_id[$key]) ? $request->category_id[$key] : '';
                    $answerdQuestion->answer = isset($request->answer[$key]) ? $request->answer[$key] : '';
                    $answerdQuestion->created_at = Carbon::now();
                    $answerdQuestion->save();
                }
            }

            Admin::where('id', Auth::guard('admin')->user()->id)
                ->update(['round_two_result' => $resultCounter, 'durationTwo' => $request->duration]);

            DB::commit();
            return redirect()->route('result.two.index')->with('success-main', 'Answer Script successfully Submitted');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Answer Script Failed To Submitted Message : ' . $e->getMessage() . ' File ' . $e->getFile() . ' Line' . $e->getLine());
            return  redirect()->route('home.page')->with('danger-main', 'Answer Script Failed To Submitted');;
        }
    }
    public function round3()
    {
        if (!empty(Auth::guard('admin')->user()->file_name)) {
            return redirect()->route('home.page')->with('danger-front', 'Already Submitted!');
        }

        return view('admin.pages.roundThree.index');
    }
    public function round3store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
        ]);

        if ($request->hasFile('file')) {
            $img = $request->file('file');
            $file_name = md5(time() . rand()) . $request->name . '.' . $img->getClientOriginalExtension();
            // $inter = Image::make($img->getRealPath());
            // $inter->filesize();
            $img->move(storage_path('app/public/roundThree/') , $file_name);
        }
        Admin::create([
            'file_name' => $file_name,
        ]);
        return redirect()->route('home.page')->with('success', 'Submitted!');
    }
    public function resultTwo()
    {
        $result = Admin::where('id', Auth::guard('admin')->user()->id)->get();
        return view('admin.pages.resultTwo.index', [
            'result' => $result,
        ]);
    }
    public function destroy($id)
    {
        $delete_id = QuestionAnswerTwo::findOrFail($id);
        $delete_id->delete();
        return back()->with('success-main', 'Question Deleted successfully');
    }

}
