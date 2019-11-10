<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\FrontendController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Route;

class LoginController extends FrontendController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/account';
    protected $guard;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Route $route)
    {
      parent::__construct($request, $route);
        $this->middleware('customerlogin', ['except' => 'logout']);
        $this->guard = Auth::guard('customer');
    }

    protected function guard()
    {
        return $this->guard;
    }

    public function showLoginForm(){
      return view('frontend.auth.login');
    }

    public function ajaxLogin(Request $request){
       
    //   $this->validateLogin($request);

    $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required',
        'role' => 'required|in:customer,affiliate',
    ]);
       

      // If the class is using the ThrottlesLogins trait, we can automatically throttle
      // the login attempts for this application. We'll key this by the username and
      // the IP address of the client making these requests into this application.
      if ($this->hasTooManyLoginAttempts($request)) {
          $this->fireLockoutEvent($request);

          return response()->json(['success' => false, 'message' => ucfirst(trans('frontend/general.login_locked'))]);
      }

      if($request->role == 'affiliate')
      {
           $this->guard = Auth::guard('affiliate');
      }

      if ($this->attemptLogin($request)) {
          if(!auth($request->role)->user()->active)
          {
              auth($request->role)->logout();
              return response()->json(['success' => false, 'message' => "Sorry! This account is not active again", 'type' => $request->role]);
          }
          return response()->json(['success' => true, 'message' => "", 'type' => $request->role]);
      }

    //   if ($this->guard()->attempt($request->all())) {
    //       if(!auth('affiliate')->user()->active)
    //       {
    //           auth('affiliate')->logout();
    //           return response()->json(['success' => false, 'message' => "Sorry! This account is not active again", 'type' => 'customer']);
    //       }
    //       return response()->json(['success' => true, 'message' => "", 'type' => 'affiliate']);
    //   }

      // If the login attempt was unsuccessful we will increment the number of attempts
      // to login and redirect the user back to the login form. Of course, when this
      // user surpasses their maximum number of attempts they will get locked out.
      $this->incrementLoginAttempts($request);
      return response()->json(['success' => false, 'message' => ucfirst(trans('frontend/general.login_email_pwd_error'))]);
    }
}
