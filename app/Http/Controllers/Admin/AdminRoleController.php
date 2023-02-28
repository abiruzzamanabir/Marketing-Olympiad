<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles= Role::orderBy("name", "asc")->get();
        $permissions= Permission::orderBy("name", "asc")->get();
        return view('admin.pages.user.role.index',[
            'roles' => $roles,
            'form_type' =>'create',
            'permissions' => $permissions,
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
        $this->validate($request,[
            'name' =>'required',
        ]);


        Role::create([
            'name' =>Str::ucfirst($request->name),
            'slug' =>Str::lower(Str::slug($request->name)),
            'permission' =>json_encode($request->permission),
        ]);


        return back() ->with('success','Role added successfully');
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
        $edit= Role::findOrFail($id);
        $roles= Role::orderBy("name", "asc")->get();
        $permissions= Permission::orderBy("name", "asc")->get();
        return view('admin.pages.user.role.index',[
            'roles' => $roles,
            'form_type' =>'edit',
            'permissions' => $permissions,
            'edit' => $edit,
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
        $update_date = Role::findOrFail($id);

        $update_date->update([
            'name' =>Str::ucfirst($request->name),
            'slug' =>Str::lower(Str::slug($request->name)),
            'permission' =>json_encode($request->permission),
        ]);

        return back() ->with('success','Role updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data= Role::findOrFail($id);
        
        $delete_data->delete();

        return back() ->with('success-main','Role deleted successfully');
    }
}
