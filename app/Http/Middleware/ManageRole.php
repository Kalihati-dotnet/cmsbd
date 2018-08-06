<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class ManageRole
{
    const DELIMITER = '|';
	protected $auth;
	/**
	 * Creates a new instance of the middleware.
	 *
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if(!is_array($roles)){
            $roles = explode(self::DELIMITER, $roles);
        }
        if(class_basename($request->user()) === "Manage"){
                if( !Auth::guest() && (Auth::guard('manage')->check() && $request->user() !== null)){
                // dd($request->user());
                    if(!$request->user()->hasRole($roles)){
                        Auth::guard('manage')->logout();
                        $request->session()->invalidate();
                        return redirect('manage/login')->with('error', 'You are not authorized!!!');
                    }
                }
            
        }
        return $next($request); 
    }
}
