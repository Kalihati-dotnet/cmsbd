<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\Permission;
use Illuminate\Contracts\Auth\Guard;

class ManagePermission
{

    const DELIMITER = '|';

    protected $auth;

    protected $guard;

    public function __construct(Guard $auth)
	{
		$this->auth = $auth;
    }
    protected $route_methods = [
        'index'=>'browse',
        'show'=>'read',
        'create'=>'add',
        'store'=>'add',
        'edit'=>'edit',
        'update'=>'edit',
        'destroy'=>'delete'
     ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    public function handle($request, Closure $next, string $exception = null)
    {

        if($request->user()->hasRole('super')){
            return $next($request);
        }
            // matching permission key with route name
           
            $premission_key = $this->keyGererate($request);
           
            if(Permission::where('key', '=', $premission_key)->exists()){
                // checking permission key that user has or not
                if(!$request->user()->hasPermission($premission_key)){
                    return redirect(route('manage.dashboard'))->with('warning', 'You are not authorized!!!');
                }
            }
        return $next($request);
    }


    private function keyGererate($request)
    {
        $route = explode('.', $request->route()->getName());
        $method = end($route);
        if(isset($this->route_methods[$method])){
            $method = $this->route_methods[$method];
        }
        array_pop($route);
        return $method . '_' . end($route);
    }


    

}
