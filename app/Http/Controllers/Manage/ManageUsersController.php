<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Models\Role as UserRole;
use App\Models\Manage as User;

use App\Http\Response\ManageUserStoreResponse;
use App\Http\Controllers\Manage\ManageController;

class ManageUsersController extends ManageController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('manage.users.index')->withUsers(
            $user->all()
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.users.create')->withRoles(
            UserRole::get()->pluck('name', 'id')->toArray()
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
            'username' => 'required|string|max:255|min:5|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        
        if (!empty($request->password)) {
            $password = trim($request->password);
        } else {
            $password = genPassword();
        }

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($password);
        $user->api_token = bin2hex(openssl_random_pseudo_bytes(30));
        $user->display_name = $request->display_name;
        $user->is_activated = true;
        $user->save();

        if ($request->role) {
            $user->roles()->sync($request->role, false);
        }
        // mailable job 
        return redirect()->route('manage.users.show', $user->id)->with('success', trans('msg.created', ['attr' => 'User']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return view("manage.users.show")->withUser(
            User::findOrFail($id)
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
        return view("manage.users.edit")->withUser(
            User::findOrFail($id)
        )->withRoles(
            UserRole::get()->pluck('name', 'id')->toArray()
        );
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
       // return $request->all();
        $user = User::findOrFail($id);
        $this->validate($request,[
           'display_name' => 'alpha_dash'
        ]);
        if (!empty($request->new_password)) {
            $user->password = bcrypt(trim($request->new_password));
        }
          $user->display_name = trim($request->display_name);
          $user->update();
    
        $role = (int) $request->roles;
        if ($role) {
            $user->roles()->sync($request->roles, true);
          }
        return redirect()->route('manage.users.show', $user->id)->with('success', trans('msg.updated', ['attr' => 'User']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
            if($find = User::findOrFail($id)){
                if($find->username === 'super'){
                    return redirect()->route('manage.users.index')->with('warning', trans('msg.danger'));
                }
                $find->delete();
                $find->roles()->detach();
                return redirect()->route('manage.users.index')->with('success', trans('msg.deleted', ['attr' => 'User']));
            }
            return abort('404');
    }
      
}
