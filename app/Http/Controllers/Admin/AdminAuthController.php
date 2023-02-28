<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginPage()
    {
        return view('admin.pages.login');
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
