<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FrontendController extends Controller
{
    public function showHomePage()
    {
        return view('frontend.pages.index', [
        ]);
    }
    public function showTCPage()
    {
        return view('frontend.pages.termsandcondition', [
        ]);
    }

    public function showExamCongratulationsPage(Request $request)
    {
        return view('frontend.pages.exam-congratulations', [
            'round' => $request->query('round'),
            'status' => $request->query('status', 'submitted'),
            'correctAnswers' => $request->query('correctAnswers'),
            'totalSubmitted' => $request->query('totalSubmitted'),
            'duration' => $request->query('duration'),
            'reason' => $request->query('reason'),
        ]);
    }
}
