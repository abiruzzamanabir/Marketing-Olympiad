<?php

namespace App\Http\Middleware\Admin;

use App\Models\Admin;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamControl;

class RoundTwoEligibilityCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $exam = ExamControl::findOrFail(1);
        $examtime = $exam->next_round_date;
        $exam_carbon = Carbon::parse($examtime);
        $exam_date = $exam_carbon->format('d'); // Output: 13
        $exam_end_time = $exam->next_round_end_date;
        $exam_end_carbon = Carbon::parse($exam_end_time);
        $exam_end_date = $exam_end_carbon->format('d');
        $exam_month = $exam_carbon->format('m'); // Output: 04
        $exam_year = $exam_carbon->format('Y'); // Output: 2023

        // echo "Date: $exam_date, Month: $exam_month, Year: $exam_year";
        $currentdatetime = now();
        $carbon = Carbon::parse($currentdatetime);

        $date = $carbon->format('d'); // Output: 13
        $month = $carbon->format('m'); // Output: 04
        $year = $carbon->format('Y'); // Output: 2023

        // echo "Date: $date, Month: $month, Year: $year";
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role->permission) {
            if (in_array($request->segment(1), json_decode(Auth::guard('admin')->user()->role->permission))) {
                Admin::where('id', Auth::guard('admin')->user()->id)->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                ]);
                if (Auth::guard('admin')->user()->selected == true) {
                    if ($carbon->between($exam_carbon, $exam_end_carbon)) {
                        return $next($request);
                    } elseif ($carbon->gt($exam_end_carbon)) {
                        return redirect()->route('home.page')->with('danger-front', 'Exam ended!');
                    } else {
                        return redirect()->route('home.page')->with('danger-front', 'Exam not started yet!');
                    }
                    // if ($date >= $exam_date && $month >= $exam_month && $year >= $exam_year && $date < $exam_end_date && $month >= $exam_month && $year >= $exam_year) {
                    //     return $next($request);
                    // } elseif ($date >= $exam_date && $month >= $exam_month && $year >= $exam_year && ($date >= $exam_end_date || $month > $exam_month || $year > $exam_year)) {

                    // } else {

                    // }
                } else {
                    return redirect()->route('home.page')->with('danger-front', 'You are not allowed to participate second round');
                }
            }
            return redirect()->route('admin.dashboard.page');
        } else {
            return redirect()->route('admin.login.page')->with('warning', 'You have to login to access this page');
        }
    }
}
