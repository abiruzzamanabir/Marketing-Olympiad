<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Mail\PasswordChangeSuccessfullMail;
use App\Mail\Mail\PasswordResetLinkMail;
use App\Models\Theme;
use Illuminate\Support\Facades\Hash;
use App\Notifications\Notification\PasswordResetNotification;
use App\Notifications\Notification\PasswordResetSuccessfullNotification;
use Illuminate\Support\Facades\Mail;

class AdminProfileController extends Controller
{
    public function ShowForgetPasswordPage()
    {
        $themes = Theme::findOrFail(1);
        return view('admin.pages.forget', [
            'theme' => $themes,
        ]);
    }

    public function ForgetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        $user_data = Admin::where('email', $request->email)->first();

        if ($user_data) {
            $token = md5(time() . rand());
            $user_data->update([
                'access_token' => $token,
            ]);
            Mail::to($request->email)->send(new PasswordResetLinkMail($user_data));
            // $user_data->notify(new PasswordResetNotification($user_data));
            return redirect()->route('admin.login.page')->with('success', 'Hi '. $user_data->first_name .' '. $user_data->last_name .', Please Check Your Email & Follow Instruction');
        } else {
            return redirect()->route('forget.password.page')->with('danger', 'Wrong Email');
        }
    }
    public function ResetPasswordLink($token = null, $email = null)
    {
        if (!$token && !$email) {
            return redirect()->route('admin.login.page')->with('failed', 'Access token or Email not found');
        }
        if ($token && $email) {

            $user_date = Admin::where('access_token', $token)->first();
            $user_date_email = Admin::where('email', $email)->first();


            if ($user_date && $user_date_email) {
                return view('admin.pages.reset', compact('email'));
            } else {
                return redirect()->route('admin.login.page')->with('warning', 'Access token or Email not matched');
            }
        }
    }
    public function ResetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed ',
        ]);
        $data = Admin::where('email', $request->email)->first();
        $password= $request->password;
        if ($data) {
            $data->update([
                'password' => Hash::make($request->password),
                'access_token' => null,
            ]);
            Mail::to($data->email)->send(new PasswordChangeSuccessfullMail($data,$password));
            // $user_data->notify(new PasswordResetSuccessfullNotification($user_data,$password));
            return redirect()->route('admin.login.page')->with('success', 'Hi '. $data->first_name .' '. $data->last_name .', Your password changed successfully');
        }



    }
}
