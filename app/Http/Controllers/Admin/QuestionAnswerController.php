<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AnswerdQuestion;
use App\Models\QuestionAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function result()
    {
        $result= Admin::where('id',Auth::guard('admin')->user()->id)->get();
        return view('admin.pages.result.index',[
            'result' => $result,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'question' =>'required',
            'option' =>'required'
        ]);

        QuestionAnswer::create([
            'question' =>$request->question,
            'option1' =>json_encode($request->option),
//            'option2' =>$request->option2,
//            'option3' =>$request->option3,
//            'option4' =>$request->option4,
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
            'option1' =>json_encode($request->option),
            'answer' =>$request->answer
        ]);
        return back()->with('success','Question updated successfully');

    }
    public function round1()
    {
        if(Auth::guard('admin')->user()->round_one_status == 1){
            return redirect()->route('admin.dashboard.page')->with('danger-main', 'You can participate exam only one time.');
        }
       Admin::where('id',Auth::guard('admin')->user()->id)->update(['round_one_status'=>true]);
        $QA= QuestionAnswer::inRandomOrder()->limit(3)->get();
        return view('admin.pages.questions.round1',[
            'question' => $QA,
        ]);
    }
    public function round1store(Request $request)
    {
        $resultCounter = 0;
        try{
          DB::beginTransaction();
          if(!empty($request->question) && count($request->question) > 0 && !empty($request->answer) && count($request->answer) > 0){
              foreach ($request->question as $key=>$value){

                  $mainResult = QuestionAnswer::find($value)->answer;
                  if(!empty($mainResult) && !empty($request->answer[$key]) && $mainResult == $request->answer[$key]){
                      $resultCounter++;
                  }

                  $answerdQuestion = new AnswerdQuestion();
                  $answerdQuestion->user_id = Auth::guard('admin')->user()->id;
                  $answerdQuestion->question_id = $value;
                  $answerdQuestion->answer = isset($request->answer[$key]) ? $request->answer[$key] : '';
                  $answerdQuestion->created_at = Carbon::now();
                  $answerdQuestion->save();
              }

          }

            Admin::where('id',Auth::guard('admin')->user()->id)->update(['round_one_result'=>$resultCounter]);

            DB::commit();
            return redirect('/dashboard')->with('success-main','Answer Script successfully Submitted');

      }catch (\Exception $e){
          DB::rollBack();
          dd($e);

      }
    }
}
