<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use Session;
use Auth;

use App\SysUserPrivilege;
use App\SysTimezone;
use App\SysSetting;
use App\SysWebsite;


class BackendController extends Controller
{

    protected $module = array();
    protected $request;
    protected $route;


    function __construct($request, $route, $module = '')
    {
        // Request, Route & Module initialization
        $this->request = $request;
        $this->route = $route;
        $this->module = $module;

        $this->middleware(function ($request, $next)
        {
            // Prevent unauthorized user to access backend page and module
            $redirect = $auth = true;
            if(!Auth::user() && !Auth::guard('api')->user())
            {
                $auth = false;
                $message = ucfirst(trans('backend/core.unauthorized_user'));
            }
            else if(!$this->has_access($this->route))
            {
                $redirect = $auth = false;
                $message = ucfirst(trans('backend/core.dont_have_access'));
            }

            // Authorized user
            if($auth)
            {
                if(Session::has('sys_error_code') && Session::get('sys_error_code') == '401')
                {
                    Session::forget('sys_error_message');
                    Session::forget('sys_error_type');
                    Session::forget('sys_error_code');
                    Session::forget('sys_error_label');
                }

                Session::put('sys_module', $this->module);
                if(Session::get('sys_website_scope') == '' OR Session::get('sys_website_scope') == null) Session::put('sys_website_scope', 0);

                // Load website list
                $sys_website = SysWebsite::all();
                config(['sys.website' => $sys_website]);

                // Load core system settings
                $sys_setting = SysSetting::where('active','1')->where('website_id','0')->get();
                foreach($sys_setting as $ss) config(['sys.setting.'.$ss->key => $ss->value]);
            }
            else
            {
                if ($this->request->ajax() OR $this->request->wantsJson() OR $this->request->isJson()) // Ajax & API request
                {
                    echo response()->json([
                        'error' => [
                            'code' => '401',
                            'label' => 'unauthorized',
                            'message' => $message
                        ]
                    ], '401');
                    exit;
                }
                else
                {
                    Session::flash('sys_error_type', 'error');
                    Session::flash('sys_error_code', '401');
                    Session::flash('sys_error_label', 'unauthorized');
                    Session::flash('sys_error_message', $message);
                    if($redirect) return redirect( url(env('BACKEND_ROUTE','managepage')) );
                }
            }

            return $next($request);

        });

    }


    protected function has_access($route = '')
    {
        if(Auth::user() != null)
        {
            if(Auth::user()->role_id != 0) // Don't check privileges on 'root' user
            {
                if(is_array($this->module) && count($this->module) > 0)
                {
                    $route_action = explode('@',$route::getCurrentRoute()->getActionName());
                    if(!array_key_exists($route_action[1],$this->module['action'])) return false;
                    else
                    {
                        $module = 'module/'.$this->module['id'].'/'.$this->module['action'][$route_action[1]];
                        $access = SysUserPrivilege::where('role_id',Auth::user()->role_id)->where('entity',$module)->where('privileges','1')->count();
                        if($access == 0)  return false;
                    }
                }
            }
            return true;
        }
        return false;
    }


    protected function get_timezone_list()
    {
        $timezone = array();
        $result = SysTimezone::orderBy('zone_name')->get();
        $group = ''; $i = 0;
        foreach($result as $r)
        {
            if($group != strstr($r->zone_name, '/', true))
            {
                $group = strstr($r->zone_name, '/', true);
                $i = 0;
            }
            $name = substr(strstr($r->zone_name, '/'),1);
            $timezone[$group][$i]['name'] = $name;
            $timezone[$group][$i]['value'] = $r->zone_name;
            $i++;
        }

        $timezone['UTC'][0]['name'] = 'UTC';
        $timezone['UTC'][0]['value'] = 'UTC';

        $manual_offset = 0;
        $timezone['Manual Offsets'][$manual_offset]['name'] = 'UTC-12';
        $timezone['Manual Offsets'][$manual_offset]['value'] = 'UTC-12';
        $manual_offset++;
        for($i = 11; $i >= 1; $i--)
        {
            $timezone['Manual Offsets'][$manual_offset]['name'] = 'UTC-'.$i.':30';
            $timezone['Manual Offsets'][$manual_offset]['value'] = 'UTC-'.$i.'.5';
            $manual_offset++;
            $timezone['Manual Offsets'][$manual_offset]['name'] = 'UTC-'.$i;
            $timezone['Manual Offsets'][$manual_offset]['value'] = 'UTC-'.$i;
            $manual_offset++;
        }
        $timezone['Manual Offsets'][$manual_offset]['name'] = 'UTC-0:30';
        $timezone['Manual Offsets'][$manual_offset]['value'] = 'UTC-0.5';
        $manual_offset++;
        for($i=0; $i<=11; $i++)
        {
            $timezone['Manual Offsets'][$manual_offset]['name'] = 'UTC+'.$i;
            $timezone['Manual Offsets'][$manual_offset]['value'] = 'UTC+'.$i;
            $manual_offset++;
            $timezone['Manual Offsets'][$manual_offset]['name'] = 'UTC+'.$i.':30';
            $timezone['Manual Offsets'][$manual_offset]['value'] = 'UTC+'.$i.'.5';
            $manual_offset++;
        }
        $timezone['Manual Offsets'][$manual_offset]['name'] = 'UTC+12';
        $timezone['Manual Offsets'][$manual_offset]['value'] = 'UTC+12';
        $manual_offset++;
        $timezone['Manual Offsets'][$manual_offset]['name'] = 'UTC+12:45';
        $timezone['Manual Offsets'][$manual_offset]['value'] = 'UTC+12.75';
        $manual_offset++;
        $timezone['Manual Offsets'][$manual_offset]['name'] = 'UTC+13';
        $timezone['Manual Offsets'][$manual_offset]['value'] = 'UTC+13';
        $manual_offset++;
        $timezone['Manual Offsets'][$manual_offset]['name'] = 'UTC+13:45';
        $timezone['Manual Offsets'][$manual_offset]['value'] = 'UTC+13.75';
        $manual_offset++;
        $timezone['Manual Offsets'][$manual_offset]['name'] = 'UTC+14';
        $timezone['Manual Offsets'][$manual_offset]['value'] = 'UTC+14';
        $manual_offset++;

        return $timezone;
    }


}
