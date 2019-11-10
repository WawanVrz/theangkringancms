<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected function guard()
    {
        return Auth::guard('customer');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customerlogin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Customer::create([
            'name' => strip_tags($data['name']),
            'email' => strip_tags($data['email']),
            'password' => bcrypt ($data['password']),
            'active' => 1
        ]);
    }

    public function ajaxRequest(Request $request){
      try{
            $validator = $this->validator($request->all());
            if($validator->fails()){
                $html="<ul>";
                foreach ($validator->errors()->all() as $message) {
                    $html .= "<li style='list-style:none; margin-left:-40px;'>".$message."</li>";
                }
                $html.= "</ul>";
                return response()->json(['success' => false, 'message' => $html]);
            }else{
                $this->create($request->all());
                return response()->json(['success' => true, 'message' => ucfirst(trans('frontend/general.login_register_success'))]);
            }
        }
        catch(\Exception $e)
        {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
