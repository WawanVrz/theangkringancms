<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Session;
use Route;
use Validator;

use App\SysSetting;
use App\SysWebsite;
use App\SysLocale;
use App\SysCountry;


class SettingGeneralController extends BackendController
{

    function __construct(Request $request, Route $route)
    {
        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'setting_general';
        $module['name'] = ucwords(trans('backend/core.general_settings'));
        $module['action'] = array(
            'index' => 'index',
            'create' => 'create',
            'store' => 'create',
            'store_general' => 'create',
            'store_contact' => 'create',
            'store_seo_url' => 'create',
            'edit' => 'edit',
            'update' => 'edit',
            'delete' => 'delete',
        );

        parent::__construct($request, $route, $module);
    }


    public function index()
    {
        $locale = SysLocale::all();
        $country = SysCountry::all();
        $website = SysWebsite::find(Session::get('sys_website_scope'));
        $timezone = $this->get_timezone_list(); 

        $object['locale']['key'] = 'locale';
        $object['locale']['value'] = $website->locale;

        if(Session::get('sys_website_scope') != 0)
        {
            $sys_setting = SysSetting::where('active','1')->where('website_id','0')->get();
            foreach($sys_setting as $ss)
            {
                $object[$ss->key]['key'] = $ss->key;
                $object[$ss->key]['value'] = $ss->value;
                $object[$ss->key]['default'] = field_default($ss->key,true);
                $object[$ss->key]['readonly'] = field_disabled();
            }
            $sys_setting = SysSetting::where('active','1')->where('website_id',Session::get('sys_website_scope'))->get();
            foreach($sys_setting as $ss)
            {
                if(array_key_exists($ss->key,$object))
                {
                    $object[$ss->key]['value'] = $ss->value;
                    $object[$ss->key]['default'] = field_default($ss->key,false);
                    $object[$ss->key]['readonly'] = '';
                }
            }
            
            if($website->locale == config('sys.website')[0]->locale)
            {
                $object['locale']['default'] = field_default('locale',true);
                $object['locale']['readonly'] = field_disabled();
            }
            else
            {
                $object['locale']['default'] = field_default('locale',false);
                $object['locale']['readonly'] = '';
            }
        }
        else
        {
            $sys_setting = SysSetting::where('active','1')->where('website_id','0')->get();
            foreach($sys_setting as $ss)
            {
                $object[$ss->key]['key'] = $ss->key;
                $object[$ss->key]['value'] = $ss->value;
                $object[$ss->key]['default'] = '';
                $object[$ss->key]['readonly'] = '';
            }
            
            $object['locale']['default'] = '';
            $object['locale']['readonly'] = '';
        }

        return view('backend.pages.setting-general',compact('object','locale','timezone','country'));

    }


    public function store_general()
    {
        $fields = [
            'website_title' => 'string',
    		'locale' => 'string',
            'timezone' => 'string',
            'start_of_week' => 'string',
    	];

        $validator = Validator::make($this->request->all(), $fields);
        
        if ($validator->fails())
        {
            $response['code'] = '422';
            $response['message'] = $validator->errors()->all();
        }
        else
        {
            \DB::beginTransaction();
            try {
                unset($fields['locale']);
                $website = SysWebsite::find(Session::get('sys_website_scope'));
                if($this->request->input('locale') != null)
                {
                    $website->locale = $this->request->input('locale');
                    $website->save();
                }

                foreach($fields as $k=>$v)
                {
                    if($this->request->input($k) != null)
                    {
                        $sys_setting = SysSetting::where('active','1')->where('website_id',Session::get('sys_website_scope'))->where('key',$k)->first();
                        if(!$sys_setting) $sys_setting = new SysSetting;
                        $sys_setting->website_id = Session::get('sys_website_scope');
                        $sys_setting->key = $k;
                        $sys_setting->value = $this->request->input($k);
                        $sys_setting->active = '1';
                        $sys_setting->save();
                    }
                    else
                    {
                        SysSetting::where('active','1')->where('website_id',Session::get('sys_website_scope'))->where('key',$k)->delete();
                    }
                }

                \DB::commit();
                $response['code'] = '200';
                $response['message'] = ucfirst(trans('backend/core.data_saved'));
            } catch (\Exception $e) {
                \DB::rollback();
                $response['code'] = '500';
                $response['message'] = $e->getmessage();
            }
        }

        echo json_encode($response);

    }


    public function store_contact()
    {
        $fields = [
            'contact_email' => 'email',
    		'phone' => 'string',
            'country' => 'string',
            'postal_code' => 'string',
            'address' => 'string',
    	];

        $validator = Validator::make($this->request->all(), $fields);
        
        if ($validator->fails())
        {
            $response['code'] = '422';
            $response['message'] = $validator->errors()->all();
        }
        else
        {
            \DB::beginTransaction();
            try {
                foreach($fields as $k=>$v)
                {
                    if($this->request->input($k) != null)
                    {
                        $sys_setting = SysSetting::where('active','1')->where('website_id',Session::get('sys_website_scope'))->where('key',$k)->first();
                        if(!$sys_setting) $sys_setting = new SysSetting;
                        $sys_setting->website_id = Session::get('sys_website_scope');
                        $sys_setting->key = $k;
                        $sys_setting->value = $this->request->input($k);
                        $sys_setting->active = '1';
                        $sys_setting->save();
                    }
                    else
                    {
                        SysSetting::where('active','1')->where('website_id',Session::get('sys_website_scope'))->where('key',$k)->delete();
                    }
                }
                \DB::commit();
                $response['code'] = '200';
                $response['message'] = ucfirst(trans('backend/core.data_saved'));
            } catch (\Exception $e) {
                \DB::rollback();
                $response['code'] = '500';
                $response['message'] = $e->getmessage();
            }
        }

        echo json_encode($response);

    }


    public function store_seo_url()
    {
        $fields = [
            'base_url' => 'url',
    		'tagline' => 'string',
            'meta_description' => 'string',
            'meta_keyword' => 'string',
    	];

        $validator = Validator::make($this->request->all(), $fields);
        
        if ($validator->fails())
        {
            $response['code'] = '422';
            $response['message'] = $validator->errors()->all();
        }
        else
        {
            \DB::beginTransaction();
            try {
                foreach($fields as $k=>$v)
                {
                    if($this->request->input($k) != null)
                    {
                        $sys_setting = SysSetting::where('active','1')->where('website_id',Session::get('sys_website_scope'))->where('key',$k)->first();
                        if(!$sys_setting) $sys_setting = new SysSetting;
                        $sys_setting->website_id = Session::get('sys_website_scope');
                        $sys_setting->key = $k;
                        $sys_setting->value = $this->request->input($k);
                        $sys_setting->active = '1';
                        $sys_setting->save();
                    }
                    else
                    {
                        SysSetting::where('active','1')->where('website_id',Session::get('sys_website_scope'))->where('key',$k)->delete();
                    }
                }
                \DB::commit();
                $response['code'] = '200';
                $response['message'] = ucfirst(trans('backend/core.data_saved'));
            } catch (\Exception $e) {
                \DB::rollback();
                $response['code'] = '500';
                $response['message'] = $e->getmessage();
            }
        }

        echo json_encode($response);

    }


}