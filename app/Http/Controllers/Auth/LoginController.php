<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Traits\RedirectTrait;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Events\Event;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    use RedirectTrait;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        $request->session()->put('redirect2', $this->redTo());

        return view('auth.login');
    }

   public function login(Request $request)
   {
  
    if($reqSession = $request->session()->get('redirect2')){
        $request->session()->forget('redirect2');
        $this->redirectTo = $reqSession;
    }

    $this->validateLogin($request);

      // If the class is using the ThrottlesLogins trait, we can automatically throttle
      // the login attempts for this application. We'll key this by the username and
      // the IP address of the client making these requests into this application.
      if ($this->hasTooManyLoginAttempts($request)) {
          $this->fireLockoutEvent($request);

          return $this->sendLockoutResponse($request);
      }

      if ($this->attemptLogin($request)) {
         // event(new Event($request));
          return $this->sendLoginResponse($request);
      }

      // If the login attempt was unsuccessful we will increment the number of attempts
      // to login and redirect the user back to the login form. Of course, when this
      // user surpasses their maximum number of attempts they will get locked out.
      $this->incrementLoginAttempts($request);

      return $this->sendFailedLoginResponse($request);
   }
   /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

       return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }



   public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect(redirect()->getUrlGenerator()->previous());
    }

}
