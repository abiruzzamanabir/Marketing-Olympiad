<?php

namespace App\Http\Middleware\Admin;

use App\Models\Admin;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role->permission) {
            if (in_array($request->segment(1), json_decode(Auth::guard('admin')->user()->role->permission))) {
                Admin::where('id', Auth::guard('admin')->user()->id)->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                ]);
                if(Auth::guard('admin')->user()->selected==true) {
                return $next($request);
                }else{
                    return redirect()->route('home.page')->with('danger-front','You are not allowed to participate second round');
                }
            }
            return redirect()->route('admin.dashboard.page');
        } else {
            return redirect()->route('admin.login.page')->with('warning','You have to login to access this page');
        }
    }
}
