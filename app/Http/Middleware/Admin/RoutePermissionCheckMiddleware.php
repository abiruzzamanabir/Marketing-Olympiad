<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutePermissionCheckMiddleware
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
                return $next($request);
            }
            return redirect()->route('admin.dashboard.page');
        } else {
            return redirect()->route('admin.login.page')->with('warning','You have to login to access this page');
        }   
    }
}
