<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Mail\AccountInformationMail;
use App\Mail\Mail\TimeAlertMail;
use App\Models\Admin;
use App\Models\ExamControl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exam = ExamControl::findOrFail(1);
        return view('admin.pages.examcontrol.index', [
            'exam' => $exam,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'round1resultstatus' => 'required',
            'round2resultstatus' => 'required',
            'minutes' => 'required',
            'seconds' => 'required',
            'question_qty' => 'required',
        ]);

        if ($request->minutes<0 || $request->seconds<1 || $request->question_qty<=0) {
            if ($request->question_qty<=0 || $request->seconds<1) {
                return back()->with('danger', 'Value must be Positive or greater than Zero');
            } else {
                return back()->with('danger', 'Value must be Positive or Zero');
            }

        }elseif($request->minutes>60 || $request->seconds>60){
            return back()->with('danger', 'Value must be between 0 and 60');
        } else {
            $exam = ExamControl::findOrFail(1);

        $exam->update([
            'round1resultstatus' => $request->round1resultstatus,
            'round2resultstatus' => $request->round2resultstatus,
            'minutes' => $request->minutes,
            'seconds' => $request->seconds,
            'question_qty' => $request->question_qty,
            'start_date_time' => $request->start_date_time,
            'end_date_time' => $request->end_date_time,
        ]);
        return back()->with('success', 'Exam Controller Updated');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function examTimeSendMailAll()
    {
        ini_set('max_execution_time',300);
       try{
           $user= Admin::where('role_id',3)->get();
           $examTime = ExamControl::first();

           $start_time = date('l, F j, Y, g:i A',strtotime($examTime->start_date_time));
           $end_time = date('l, F j, Y, g:i A',strtotime($examTime->end_date_time));

           foreach ($user as $key=>$val){
               $fullName = $val->first_name .' '. $val->last_name;
               $details = [
                   'name'=> $fullName,
                   'start_time' => $start_time,
                   'end_time' => $end_time,
               ];
               Mail::to($val->email)->send(new TimeAlertMail($details));

//               Mail::send('admin.mail.ExamTime', $details, function($message) use ($details, $val){
//                   $message->to($val->email);
//                   $message->subject('Exam Time Alert');
////                $message->html($details['email_body']);
//               });
           }
           return back()->with('success', 'Mail Send Successfully Done');
       }catch (\Exception $e){
           Log::error('Something is wrong to send Mail with error messge:- '.$e->getMessage());
           dd($e);
           return back()->with('danger', 'Something is wrong to send Mail with error messge:- '.$e->getMessage());
       }


    }
}
