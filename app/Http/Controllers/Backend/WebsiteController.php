<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Session;
use Route;
use Validator;
use URL;
use Auth;
use App\SysLogging;
use App\SysLang;
use App\SysSetting;
use App\SysWebsite;
use App\SysLocale;
use App\SysCountry;

class WebsiteController extends BackendController
{

    function __construct(Request $request, Route $route)
    {
        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'website';
        $module['name'] = ucwords(trans('backend/core.website'));
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


    public function index()
    {
        $object = SysWebsite::all();
        foreach($object as $o)
        {
            if($o->id == 0) $o->default = true;
            else $o->default = false;
            
            $result = SysSetting::where('key','base_url')->where('website_id',$o->id)->first();
            if($result != null) $o->base_url = $result->value;
            else $o->base_url = SysSetting::where('key','base_url')->where('website_id','0')->first()->value;
        }
        
        return view('backend.pages.website',compact('object'));
    }


    public function store()
    {
        // dd($this->request->input());
        $website = new SysWebsite;

        $fields = [
            'name' => 'required',
    		'code' => 'required|alpha_dash|unique:'.$website->getTable().',code',
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
                if($this->request->input('enable') != null) $website->enable = '1';
                else $website->enable = '0';
                $website->name = $this->request->input('name');
                $website->code = $this->request->input('code');
                $website->locale = 'en';
                $website->save();
                \DB::commit();

                SysLang::create([
                    'name' => $this->request->input('name'),
                    'code' => $this->request->input('code'),
                ]);
                \DB::commit();
                
                //----- SAVE TO TBL LOG -------
                $links = URL::to('/');
                SysLogging::create([
                    'user_id' => Auth::user()->id,
                    'fullname' => Auth::user()->username,
                    'user_role' => Auth::user()->role_id,
                    'status' => 'Create',
                    'content_type' => 'Website',
                    'website_id' => 0,
                    'url' => $links,
                    'notes' => Auth::user()->username.' has created this website : '.$this->request->input('name'),
                    'ac' => 1
                ]);
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


    public function update()
    {
        // dd($this->request->input());
        $sys_website = new SysWebsite;

        $fields = [
            'id' => 'required',
            'name' => 'required',
    		'code' => 'required|alpha_dash|unique:'.$sys_website->getTable().',code,'.$this->request->input('id'),
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
                unset($fields['id']);
                $website = SysWebsite::find($this->request->input('id'));
                if($this->request->input('enable') != null) $website->enable = '1';
                else $website->enable = '0';
                $website->name = $this->request->input('name');
                $website->code = $this->request->input('code');
                $website->save();
                \DB::commit();

                //----- SAVE TO TBL LOG -------
                $links = URL::to('/');
                SysLogging::create([
                    'user_id' => Auth::user()->id,
                    'fullname' => Auth::user()->username,
                    'user_role' => Auth::user()->role_id,
                    'status' => 'Update',
                    'content_type' => 'Website',
                    'website_id' => 0,
                    'url' => $links,
                    'notes' => Auth::user()->username.' has changed something on this website : '.$this->request->input('name'),
                    'ac' => 1
                ]);
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


    public function delete($id)
    {
        if($object = SysWebsite::find($id))
        {
            //----- SAVE TO TBL LOG -------
            $links = URL::to('/');
            SysLogging::create([
                'user_id' => Auth::user()->id,
                'fullname' => Auth::user()->username,
                'user_role' => Auth::user()->role_id,
                'status' => 'Delete',
                'content_type' => 'Website',
                'website_id' => 0,
                'url' => $links,
                'notes' => Auth::user()->username.' has deleted this website : '.$object->name,
                'ac' => 1
            ]);
            \DB::commit();

            // delete website setting
            SysSetting::where('website_id',$id)->delete();
            $object->delete();    

            $landata = SysLang::find($id);
            $landata->delete(); 
        }

        // reset website setting scope to default
        Session::put('sys_website_scope', 0);

    	Session::flash('flash_message_success', ucfirst(trans('backend/core.website_deleted')));
        return redirect(url(env('BACKEND_ROUTE').'/website'));
    }


}