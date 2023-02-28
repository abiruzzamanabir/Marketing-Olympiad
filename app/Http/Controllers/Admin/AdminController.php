<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\Notification\AccountInformationNotification;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Admin::orderBy("fast_name", "asc")->where('trash', false)->get();
        $roles = Role::orderBy("id", "asc")->get();
        return view('admin.pages.user.index', [
            'all_admin' => $admin,
            'form_type'  => 'create',
            'roles'  => $roles,
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
            'fast_name' => 'required|unique:admins',
            'email' => 'required|email|unique:admins',
            'username' => 'required|unique:admins',
            'cell' => 'required|unique:admins',
            'role_id' => 'required',
        ]);

        $password = substr(str_shuffle('1234567890!@#$%&*()qwertyuiop[]asdfghjklzxcvbnm'), 10, 10);


        $user = Admin::create([
            'fast_name' => $request->fast_name,
            'email' => $request->email,
            'username' => $request->username,
            'cell' => $request->cell,
            'role_id' => $request->role_id,
            'password' => Hash::make($password),
        ]);
        $user->notify(new AccountInformationNotification($user, $password));
        return back()->with('success', 'Account created successfully');
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
        $admin = Admin::orderBy("fast_name", "asc")->get();
        $user = Admin::findOrFail($id);
        $role = Role::orderBy("name", "asc")->get();
        return view('admin.pages.user.index', [
            'all_admin' => $admin,
            'form_type'  => 'edit',
            'edit'  => $user,
            'roles'  => $role,
        ]);
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
        $update_date = Admin::findOrFail($id);

        $update_date->update([
            'fast_name' => Str::ucfirst($request->fast_name),
            'cell' => $request->cell,
            'role_id' => $request->role_id,
        ]);

        return back()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id = Admin::findOrFail($id);
        $delete_id->delete();
        unlink('storage/admins/' . $delete_id->photo);


        return back()->with('success-main', 'Account Deleted successfully');
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
        }
        return back()->with('success-main', 'Status updated successfully');
    }
    public function updateTrash($id)
    {
        $data = Admin::findOrFail($id);


        if ($data->trash) {
            $data->update([
                'status' => true,
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

    public function trashUsers()
    {
        $admin = Admin::orderBy("fast_name", "asc")->where('trash', true)->get();
        return view('admin.pages.user.trash', [
            'all_admin' => $admin,
            'form_type'  => 'trash',
        ]);
    }
}
