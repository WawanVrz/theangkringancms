<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use App\Traits\General;

use Auth;
use Session;


class AuthController extends Controller
{
    
    use General;

    public function index()
    {
        $this->load_system_setting();
        if(!Auth::user() && !Auth::guard('api')->user()) return view('backend.pages.auth-login');
        else if(Auth::user()->role_id > 1) return view('backend.pages.auth-login'); // Prevent "non admin" user to access backend module
        else return redirect(url(env('BACKEND_ROUTE','managepage').'/dashboard'));
    }


    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => '1'])) 
        {
            return redirect()->intended( url(env('BACKEND_ROUTE','managepage').'/dashboard') );
        }
        else
        {
            $this->error_response('error', ucfirst(trans('backend/core.invalid_user')), '401', 'unauthorized');   
            return redirect( url(env('BACKEND_ROUTE','managepage')) );
        }
    }
    
    
    public function logout()
    {
        Auth::logout();
        return redirect( url(env('BACKEND_ROUTE','managepage')) );
    }

}