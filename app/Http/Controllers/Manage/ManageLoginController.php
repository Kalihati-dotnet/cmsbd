<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Manage\ManageController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Manage as ManageUser;
use Hash;
use Auth;


class ManageLoginController extends ManageController
{
    use AuthenticatesUsers;

    protected $redirectTo = 'manage/dashboard';

    public function __construct()
    {
        $this->middleware('guest:manage')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('manage.auth.login');
    }


    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }
    protected function credentials(Request $request)
    {
        return array_add(($request->only($this->username(), 'password')),'is_activated',1);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];
        // Load user from database
        $user = ManageUser::where($this->username(), $request->{$this->username()})->first();
        
        if(!$user){
            $errors = [$this->username() => trans('auth.error.email')];
        }
        if($user && !Hash::check($request->password, $user->password)){
            $errors = ['password' => trans('auth.error.password')];
        }
        if ($user && Hash::check($request->password, $user->password) && $user->is_activated != 1) {
            $errors = ['activation_error' => trans('auth.error.activation')];
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    // protected function sendLoginResponse(Request $request)
    // {


    //     $request->session()->regenerate();

    //     $this->clearLoginAttempts($request);

    //     return $this->authenticated($request, $this->guard()->user())
    //             ?: redirect()->intended($this->redirectPath());
    // $errors = [$this->username() => trans('auth.failed')];
    // // Load user from database
    // $user = \App\User::where($this->username(), $request->{$this->username()})->first();
    // // Check if user was successfully loaded, that the password matches
    // // and active is not 1. If so, override the default error message.
    // if ($user && \Hash::check($request->password, $user->password) && $user->active != 1) {
    //     $errors = [$this->username() => 'Your account is not active.'];
    // }
    // if ($request->expectsJson()) {
    //     return response()->json($errors, 422);
    // }
    // return redirect()->back()
    //     ->withInput($request->only($this->username(), 'remember'))
    //     ->withErrors($errors);
    // }
    public function logout(Request $request)
    {
       // return $request->all();
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('manage/login');
    }

    protected function guard()
    {
        return Auth::guard('manage');
    }
}
