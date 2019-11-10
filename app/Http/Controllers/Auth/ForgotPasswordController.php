<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\FrontendController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Route;

class ForgotPasswordController extends FrontendController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Route $route)
    {
        $this->middleware('customerlogin');
        parent::__construct($request, $route);
    }

    public function broker($broker)
    {
        return Password::broker($broker);
    }

    public function showLinkRequestForm()
    {
        return view('frontend.auth.password.email');
    }

    public function sendResetLinkEmailAjax(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
       $response = $this->broker($request->role)->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponseAjax($response)
                    : $this->sendResetLinkFailedResponseAjax($request, $response);
    }

    protected function sendResetLinkResponseAjax($response)
    {
      return response()->json(['success' => true, 'msg' => trans($response)]);
    }

    protected function sendResetLinkFailedResponseAjax(Request $request, $response)
    {
        return back()->withErrors(
            ['email' => trans($response)]
        );
    }
}
