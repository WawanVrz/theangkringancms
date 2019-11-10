<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Database\Schema\Blueprint;
use App\Http\Controllers\Controller;

use Validator;
use Session;
use Schema;
use Config;
use Route;
use Auth;
use File;
use Lang;
use DB;
use URL;
use App\SysLogging;
use App\SysOtherSetting;
use App\SysSetting;

use App\Traits\ContentData;

class OtherSettingController extends BackendController
{
    function __construct(Request $request, Route $route)
    {
        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'othersetting';
        $module['name'] = 'othersetting';
        $module['action'] = array(
            'index' => 'index',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'edit',
            'update' => 'edit',
            'delete' => 'delete',
        );
        parent::__construct($request, $route, $module);
    }

    public function index($id)
    {
        $sysothersetting_data = SysOtherSetting::find($id);
        if($sysothersetting_data)
        {
            return view('backend.pages.content-edit-othersetting',compact('sysothersetting_data'));
        }
        else
        {
            Session::flash('flash_message_warning', ucfirst(trans('backend/core.data_not_found')));
            return redirect(url(env('BACKEND_ROUTE').'/other/1'));
        }
    }

    public function update(Request $request, $id)
    {
        $sysothersetting_data = $request->except('_token');
        $sysothersettinglist = SysOtherSetting::find($id);
        
        DB::beginTransaction();
        try{
            $redirect_failed = url(env('BACKEND_ROUTE').'/setting/other/'.$id);
            $redirect_success = url(env('BACKEND_ROUTE').'/setting/other/'.$id);
    
            $imgs = $request->input('logo');
           
            if($request->hasFile('logo'))
            {
                 $imgsfile = $request->file('logo');
                $filename = (string)(time() . '_logo_tttm.'.$imgsfile->getClientOriginalExtension());
                $request->file('logo')->move('media/upload/logo/', $filename);
                $sysothersetting_data['logo'] = $filename;
                $sysothersetting_data['logo'] = $sysothersetting_data['logo'];
            }
            else
            {
                unset($sysothersetting_data['logo']);
            }

            if($request->hasFile('logo'))
            {
                DB::table('sys_other_setting')
                    ->where('id', $id)
                    ->update([
                            'logo' => $filename,
                            'google_analytics' => $request->input('ga'),
                            'facebook_pixel' =>  $request->input('fbp'),
                            'google_map_api_key' =>  $request->input('gma'),
                            'mailchimp_api_key' => '',
                            'status' => 1,
                    ]);
            }
            else
            {
                DB::table('sys_other_setting')
                    ->where('id', $id)
                    ->update([
                            'google_analytics' => $request->input('ga'),
                            'facebook_pixel' =>  $request->input('fbp'),
                            'google_map_api_key' =>  $request->input('gma'),
                            'mailchimp_api_key' => '',
                            'status' => 1,
                    ]);
            }
           DB::commit();

           //----- SAVE TO TBL LOG -------
           $links = URL::to('/');
           SysLogging::create([
               'user_id' => Auth::user()->id,
               'fullname' => Auth::user()->username,
               'user_role' => Auth::user()->role_id,
               'status' => 'Update',
               'content_type' => 'Setting',
               'website_id' => 0,
               'url' => $links,
               'notes' => Auth::user()->username.' has changed something on this setting : '.$links,
               'ac' => 1
           ]);
           \DB::commit();

           Session::flash('flash_message_success', 'Data Has Been Successfully Updated');
           return redirect($redirect_success);
        }catch(Exception $e){
            Session::flash('flash_message_danger', $e->getmessage());
            DB::rollback();
            throw $e;
        }
    }
}
