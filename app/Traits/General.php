<?php 

namespace App\Traits;

use Session;
use Request;

use App\SysSetting;

trait General
{

    protected function load_system_setting()
    {
        // Load core system settings
        $sys_setting = SysSetting::where('active','1')->where('website_id','0')->get();
        foreach($sys_setting as $ss) config(['sys.setting.'.$ss->key => $ss->value]);
    }


    protected function error_response($type = 'error', $message = '', $code = '200', $label = 'error')
    {   
        if (Request::ajax() OR Request::wantsJson() OR Request::isJson()) // Ajax & API request
        {
            echo response()->json([
                $type => [
                    'code' => $code,
                    'label' => $label,
                    'message' => $message
                ]
            ], $code);
            exit;
        }
        else
        {
            Session::flash('sys_error_type', $type);
            Session::flash('sys_error_code', $code);
            Session::flash('sys_error_label', $label);
            Session::flash('sys_error_message', $message);
        } 
    }

}