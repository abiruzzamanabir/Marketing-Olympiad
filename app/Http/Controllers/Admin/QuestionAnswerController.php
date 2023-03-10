<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;

class QuestionAnswerController extends Controller
{
    public function index()
    {
        $QA= QuestionAnswer::get();
        return view('admin.pages.questions.index',[
            'question' => $QA,
            'form_type' =>'create',
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'question' =>'required',
            'option1' =>'required',
            'option2' =>'required',
            'option3' =>'required',
            'option4' =>'required',
            'answer' =>'required',
        ]);

        QuestionAnswer::create([
            'question' =>$request->question,
            'option1' =>$request->option1,
            'option2' =>$request->option2,
            'option3' =>$request->option3,
            'option4' =>$request->option4,
            'answer' =>$request->answer,
        ]);


        return back() ->with('success','Question added successfully');
    }
    public function edit($id)
    {
        $QA= QuestionAnswer::get();
        $qno= QuestionAnswer::findOrFail($id);
        return view('admin.pages.questions.index',[
            'question' => $QA,
            'edit'  => $qno,
            'form_type' =>'edit',
        ]);
    }
    public function update(Request $request, $id)
    {
        $update_data= QuestionAnswer::findOrFail($id);
        $update_data->update([
            'question' =>$request->question,
            'option1' =>$request->option1,
            'option2' =>$request->option2,
            'option3' =>$request->option3,
            'option4' =>$request->option4,
            'answer' =>$request->answer,
        ]);
        return back()->with('success','Question updated successfully');

    }
    public function round1()
    {
        $QA= QuestionAnswer::inRandomOrder()->limit(3)->get();
        return view('admin.pages.questions.round1',[
            'question' => $QA,
        ]);
    }
    public function round1store(Request $request)
    {
return $request->all();

        QuestionAnswer::create([
            'question' =>$request->question,
            'option1' =>$request->option1,
            'option2' =>$request->option2,
            'option3' =>$request->option3,
            'option4' =>$request->option4,
            'answer' =>$request->answer,
        ]);


        return back() ->with('success','Question added successfully');
    }
}
