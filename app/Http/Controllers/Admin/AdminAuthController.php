<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginPage()
    {
        $themes = Theme::findOrFail(1);
        return view('admin.pages.login', [
            'theme' => $themes,
        ]);
    }

    public function Login(Request $request)
    {
        $this->validate($request, [
            'email_cell_username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt([
            'email' => $request->email_cell_username,
            'password' => $request->password,
        ]) || Auth::guard('admin')->attempt([
            'cell' => $request->email_cell_username,
            'password' => $request->password,
        ]) || Auth::guard('admin')->attempt([
            'username' => $request->email_cell_username,
            'password' => $request->password,
        ])) {
            if (Auth::guard('admin')->user()->status != true) {
                if (Auth::guard('admin')->user()->role_id===3) {
                    if (Auth::guard('admin')->user()->blocked==true) {
                        Auth::guard('admin')->logout();
                        return redirect()->route('admin.login.page')->with('danger','Your account is blocked.Please contact with Admin');
                    } else {
                        Auth::guard('admin')->logout();
                        return redirect()->route('admin.login.page')->with('warning','Your account is not verified yet. Please wait.');
                    }
                    
                } else {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login.page')->with('warning','Your account is blocked. Please contact with Admin');
                }
                
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login.page')->with('warning','Your account is blocked. Please contact with Admin');
            } else {
                return redirect()->route('admin.dashboard.page');
            }
            
            
        } else {
            return redirect()->route('admin.login.page')->with('warning', 'Email or Password incorrect');
        }
    }
    public function Logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.page')->with('success', 'Logout Successfully');
    }
}
