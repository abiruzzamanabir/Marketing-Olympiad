<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ExamControl;
use Illuminate\Http\Request;

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
    public function examTimeSendMailAll(Request $request)
    {
        // return $request->all();
        $user= Admin::all();
        dd($user);
    }
}
