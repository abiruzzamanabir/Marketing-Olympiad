<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Mail\PasswordChangeSuccessfullMail;
use App\Models\Theme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Notifications\Notification\PasswordChangeSuccessfullNotification;
use Illuminate\Support\Facades\Mail;

class AdminPageController extends Controller
{
    public function showDashboardPage()
    {
        $themes = Theme::findOrFail(1);
        return view('admin.pages.dashboard', [
            'theme' => $themes,
        ]);
    }
    public function showProfilePage()
    {
        $themes = Theme::findOrFail(1);
        return view('admin.pages.profile', [
            'theme' => $themes,
        ]);
    }
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'email' => 'required|email',
            'cell' => 'required|',
            'gender' => 'required|in:Male,Female',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
        ]);

        if ($request->hasFile('new_photo')) {
            $img = $request->file('new_photo');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/admins/') . $file_name);
        } else {
            $file_name = $request->old_photo;
        }

        $id = Auth::guard('admin')->user()->id;
        $user = Admin::findOrFail($id);
        $user->update([
            'first_name' => Str::ucfirst($request->first_name),
            'last_name' => Str::ucfirst($request->last_name),
            'dob' => $request->dob,
            'email' => Str::ucfirst($request->email),
            'cell' => $request->cell,
            'gender' => $request->gender,
            'address' => Str::ucfirst($request->address),
            'city' => Str::ucfirst($request->city),
            'state' => Str::ucfirst($request->state),
            'zip' => $request->zip,
            'country' => Str::ucfirst($request->country),
            'photo' => $file_name,
        ]);

        return back()->with('success', 'Profile updated successfully');
    }


    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        if (!password_verify($request->old_password, Auth::guard('admin')->user()->password)) {
            return back()->with('danger', 'Old Password not mathed');
        }

        if ($request->password != $request->password_confirmation) {
            return back()->with('warning', 'Password Not Matched');
        }
        if ($request->old_password == $request->password) {
            return back()->with('warning', 'Old Password & New Password Same');
        }

        $data = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $password = $request->password;
        $data->update([
            'password' => Hash::make($request->password)
        ]);

        Mail::to($data->email)->send(new PasswordChangeSuccessfullMail($data,$password));
        // $data->notify(new PasswordChangeSuccessfullNotification($data,$password));
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login.page')->with('success', 'Password Changed successfully');
    }
}
