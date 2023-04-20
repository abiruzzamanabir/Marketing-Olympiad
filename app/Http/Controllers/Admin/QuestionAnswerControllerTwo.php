<?php

namespace App\Http\Controllers\Admin;

use App\Models\CategoryTwo;
use Illuminate\Http\Request;
use App\Models\QuestionAnswerTwo;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use App\Imports\QuestionAnswerImportTwo;
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
    public function destroy($id)
    {
        $delete_id = QuestionAnswerTwo::findOrFail($id);
        $delete_id->delete();
        return back()->with('success-main', 'Question Deleted successfully');
    }
}
