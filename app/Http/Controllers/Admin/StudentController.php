<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Mail\AccountInformationMail;
use App\Mail\Mail\AccountVerifiedMail;
use App\Mail\Mail\SelectedMail;
use App\Models\ExamControl;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Notifications\Notification\AccountInformationNotification;
use App\Notifications\Notification\AccountVerifiedNotification;
use Illuminate\Support\Facades\Mail;

/**
 * Summary of StudentController
 */
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = Theme::findOrFail(1);
        return view('admin.pages.register', [
            'theme' => $themes,
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
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:admins',
            'cell' => 'required|unique:admins',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'uniname' => 'required',
            'dob' => 'required',
            'nid' => 'required|unique:admins',
            'stuid' => 'required|unique:admins',
            'photo' => 'required',
            'nidphotofront' => 'required',
            'nidphotoback' => 'required',
            'stuphotofront' => 'required',
            'stuphotoback' => 'required',
        ]);

        $password = substr(str_shuffle('1234567890!@#$%&*()qwertyuiop[]asdfghjklzxcvbnm'), 10, 10);
        $username = $request->first_name . $request->last_name . substr(str_shuffle('1234567890'), 4, 3);

        if ($request->hasFile('photo')) {
            $img = $request->file('photo');
            $file_name = md5(time() . rand()) . $request->first_name . '_' . $request->last_name . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/admins/') . $file_name);
        } else {
            $file_name = '';
        }
        if ($request->hasFile('nidphotofront')) {
            $img = $request->file('nidphotofront');
            $nid_f_file_name = md5(time() . rand()) . 'NID_Front' . $request->first_name . '_' . $request->last_name . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/studentNidFront/') . $nid_f_file_name);
        } else {
            $nid_f_file_name = '';
        }
        if ($request->hasFile('nidphotoback')) {
            $img = $request->file('nidphotoback');
            $nid_b_file_name = md5(time() . rand()) . 'NID_Back' . $request->first_name . '_' . $request->last_name . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/studentNidBack/') . $nid_b_file_name);
        } else {
            $nid_b_file_name = '';
        }
        if ($request->hasFile('stuphotofront')) {
            $img = $request->file('stuphotofront');
            $sid_f_file_name = md5(time() . rand()) . 'SID_Front' . $request->first_name . '_' . $request->last_name . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/studentSidFront/') . $sid_f_file_name);
        } else {
            $sid_f_file_name = '';
        }
        if ($request->hasFile('stuphotoback')) {
            $img = $request->file('stuphotoback');
            $sid_b_file_name = md5(time() . rand()) . 'SID_Back' . $request->first_name . '_' . $request->last_name . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/studentSidBack/') . $sid_b_file_name);
        } else {
            $sid_b_file_name = '';
        }

        $mac = 'UNKNOWN';
        foreach (explode("\n", str_replace(' ', '', trim(`getmac`, "\n"))) as $i)
            if (strpos($i, 'Tcpip') > -1) {
                $mac = substr($i, 0, 17);
                break;
            }

        $user = Admin::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $username,
            'cell' => $request->cell,
            'role_id' => 3,
            'password' => Hash::make($password),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'uniname' => $request->uniname,
            'dob' => $request->dob,
            'nid' => $request->nid,
            'stuid' => $request->stuid,
            'photo' => $file_name,
            'mac' => $mac,
            'nidphotofront' => $nid_f_file_name,
            'nidphotoback' => $nid_b_file_name,
            'stuphotofront' => $sid_f_file_name,
            'stuphotoback' => $sid_b_file_name,
            'status' => true,
        ]);

        $data=[
            'name' => $request->first_name . $request->last_name,
            'username' => $request->username,
            'cell' => $request->cell,
            'email' => $request->email,
            'password' => $password,
        ];

        Mail::to($request->email)->send(new AccountInformationMail($data,$username));

        // $user->notify(new AccountInformationNotification($user, $password));
        return redirect()->route('admin.login.page')->with('success', 'Account created successfully. Please Check Your Email.');
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
        //
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

    public function updateStatus($id)
    {
        $data = Admin::findOrFail($id);


        if ($data->status) {
            $data->update([
                'status' => false,
            ]);
        } else {
            $data->update([
                'status' => true,
            ]);

            Mail::to($data->email)->send(new AccountVerifiedMail($data));
            // $data->notify(new AccountVerifiedNotification($data));
        }
        return back()->with('success-main', 'Status updated successfully');
    }
    public function updateSelectStatus($id)
    {
        $data = Admin::findOrFail($id);
        $examTime = ExamControl::first();



        if ($data->selected) {
            $data->update([
                'selected' => false,
            ]);
        } else {
            $data->update([
                'selected' => true,
            ]);
            $fullName = $data->first_name .' '. $data->last_name;
            $next_round_date = date('l, F j, Y, g:i A',strtotime($examTime->next_round_date));
            $information=[
                'name'=> $fullName,
                'next_round_date' => $next_round_date,
            ];

            // Mail::to($data->email)->send(new AccountVerifiedMail($data));
            // $data->notify(new AccountVerifiedNotification($data));
            // Mail::to($data->email)->send(new SelectedMail($information));

        }
        return back()->with('success-main', 'Selected status updated successfully');
    }
    public function updateTrash($id)
    {
        $data = Admin::findOrFail($id);


        if ($data->trash) {
            $data->update([
                'status' => false,
                'trash' => false,
            ]);
        } else {
            $data->update([
                'status' => false,
                'trash' => true,
            ]);
        }
        return back()->with('success-main', 'Trash updated successfully');
    }
    public function verifiedStudent()
    {
        $admin = Admin::orderBy("first_name", "asc")->where('status', true)->where('blocked', false)->where('role_id', 3)->where('trash', false)->get();
        $themes = Theme::findOrFail(1);
        return view('admin.pages.student.index', [
            'all_admin' => $admin,
            'form_type'  => 'create',
            'voruv'  => 'v',
            'theme' => $themes,
        ]);
    }
    // public function unverifiedStudent()
    // {
    //     $admin = Admin::orderBy("first_name", "asc")->where('status', false)->where('blocked', false)->where('role_id', 3)->where('trash', false)->get();
    //     $themes = Theme::findOrFail(1);
    //     return view('admin.pages.student.index', [
    //         'all_admin' => $admin,
    //         'form_type'  => 'create',
    //         'voruv'  => 'uv',
    //         'theme' => $themes,
    //     ]);
    // }
    public function roundOneResult()
    {
        $admin = Admin::orderBy("round_one_result", "DESC")->orderBy("duration", "ASC")->where('round_one_status', true)->where('blocked', false)->where('role_id', 3)->where('trash', false)->limit(1000)->get();
        $themes = Theme::findOrFail(1);
        return view('admin.pages.student.result', [
            'all_admin' => $admin,
            'form_type'  => 'create',
            'theme' => $themes,
        ]);
    }


    /**
     * Summary of roundOneFinalResult
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function roundOneFinalResult()
    {
        $admin = Admin::orderBy('round_one_result', 'DESC')->orderBy('duration', 'ASC')->where('round_one_status', true)->where('selected', true)->where('blocked', false)->where('role_id', 3)->where('trash', false)->get();
        $themes = Theme::findOrFail(1);
        return view('admin.pages.result.roundOneResult', [
            'all_admin' => $admin,
            'theme' => $themes,
        ]);
    }


    public function trashStudent()
    {
        $admin = Admin::orderBy("first_name", "asc")->where('trash', true)->where('role_id', 3)->get();
        $themes = Theme::findOrFail(1);
        return view('admin.pages.student.trash', [
            'all_admin' => $admin,
            'form_type'  => 'trash',
            'theme' => $themes,
        ]);
    }
    public function blockStudent()
    {
        $admin = Admin::orderBy("first_name", "asc")->where('blocked', true)->where('role_id', 3)->get();
        $themes = Theme::findOrFail(1);
        return view('admin.pages.student.trash', [
            'all_admin' => $admin,
            'form_type'  => 'ban',
            'theme' => $themes,
        ]);
    }
    public function banStudent($id)
    {
        $data = Admin::findOrFail($id);


        if ($data->blocked) {
            $data->update([
                'blocked' => false,
                'status' => false
            ]);
        } else {
            $data->update([
                'blocked' => true,
                'status' => false
            ]);
        }
        return back()->with('success-main', 'Ban updated successfully');
    }
    public function destroyStudent($id)
    {
        $delete_id = Admin::findOrFail($id);
        if ($delete_id->photo == 'avatar.png') {
            $delete_id->delete();
        } else {
            $delete_id->delete();
            unlink('storage/admins/' . $delete_id->photo);
            unlink('storage/studentNidFront/' . $delete_id->nidphotofront);
            unlink('storage/studentNidBack/' . $delete_id->nidphotoback);
            unlink('storage/studentSidFront/' . $delete_id->stuphotofront);
            unlink('storage/studentSidBack/' . $delete_id->stuphotoback);
        }

        return back()->with('success-main', 'Account Deleted successfully');
    }
}
