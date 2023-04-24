<?php

namespace App\Http\Middleware\Admin;

use App\Models\Admin;
use App\Models\ExamControl;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoundOneCheckMiddleware
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
        $currentdatetime = now();
        $carbon = Carbon::parse($currentdatetime);
        $exam_carbon = Carbon::parse($exam->start_date_time);
        $exam_end_carbon = Carbon::parse($exam->end_date_time);

        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role->permission) {
            if (in_array($request->segment(1), json_decode(Auth::guard('admin')->user()->role->permission))) {
                Admin::where('id', Auth::guard('admin')->user()->id)->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                ]);

                if ($carbon->between($exam_carbon, $exam_end_carbon)) {
                    return $next($request);
                } elseif ($carbon->gt($exam_end_carbon)) {
                    return redirect()->route('home.page')->with('danger-front', 'Exam ended!');
                } else {
                    return redirect()->route('home.page')->with('danger-front', 'Exam not started yet!');
                }
            }else{
                return redirect()->route('admin.dashboard.page');
            }
        } else {
            return redirect()->route('admin.login.page')->with('warning', 'You have to login to access this page');
        }
    }
}
