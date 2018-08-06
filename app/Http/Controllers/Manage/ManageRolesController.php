<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Models\Role as ManageRole;
use App\Models\Permission as ManagePermission;
use App\Http\Controllers\Manage\ManageController;

class ManageRolesController extends ManageController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.roles.index')->withRoles(
            ManageRole::all()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.roles.create')->withPermissions(
            ManagePermission::all()->groupBy('table_name')
        );
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
            'name' => 'required|regex:/^[a-zA-Z_. ]*$/|max:255|min:2|unique:roles',
        ]);

        $role = new ManageRole;
        $role->name = $request->name;
        $role->display_name = $request->display_name;

        $role->save();
        if($request->permissions){
            $role->perms()->sync($request->permissions, false);
        }
        return redirect()->route('manage.roles.show', $role->id)->with('success', trans('msg.created', ['attr' => 'Role']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("manage.roles.show")->withRole(
            ManageRole::findOrFail($id)
        )->withPermissions(
            ManagePermission::all()->groupBy('table_name')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("manage.roles.edit")->withRole(
            ManageRole::findOrFail($id)
        )->withPermissions(
            ManagePermission::all()->groupBy('table_name')
        );
        // ->withPermissionKeys(
        //     ManagePermission::all()->pluck('key')->toArray()
        // )
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
        $role = ManageRole::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|alpha_dash|max:255|min:2|unique:roles,name,' . $role->id,
            // 'display_name' => 'regex:/^[a-zA-Z_.\s]*$/|',
        ]);
        

        $role->name = $request->name;
        $role->display_name = $request->display_name;

        $role->update();
        if($request->permissions){
            $role->perms()->sync($request->permissions, true);
        }  else {
            $role->perms()->sync(null, true);
        }
        return redirect()->route('manage.roles.show', $role->id)->with('success', trans('msg.updated', ['attr' => 'Role']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        // if($request->ajax()){
            if($find = ManageRole::findOrFail($id)){
                if($find->manageUsers->count() === 0){
                    $find->delete();
                    return redirect()->route('manage.roles.index')->with('success', 'Role Deleted');
                }
                return redirect('manage/roles')->with('error', 'It has an active user');
            }
            return abort('404');
    }
}
