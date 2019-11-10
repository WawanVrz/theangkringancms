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

use App\Sosmed;
use App\SysSetting;

use App\Traits\ContentData;

class SosmedController extends BackendController
{
    function __construct(Request $request, Route $route)
    {
        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'sosmed';
        $module['name'] = 'sosmed';
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
        $list= Sosmed::all();
        return view('backend.pages.content-listing-sosmed',compact('list'));
    }

    public function create()
    {
        return view('backend.pages.content-create-sosmed');
    }

    public function store(Request $request)
    {
        $fields = [
            'authors' => 'required',
            'website_id' => 'required',
            'name' => 'required',
            'url' => 'required',
        ];
        $message = [];
        $validator = Validator::make($request->all(), $fields, $message);
        
        //dd($request->input('limittype'));
        $list= Sosmed::all();
        $redirect_failed = url(env('BACKEND_ROUTE').'/setting/social/media/create');
        $redirect_success = url(env('BACKEND_ROUTE').'/setting/social/media');

        if ($validator->fails()) return redirect($redirect_failed)->withErrors($validator)->withInput();

        if(count($list) == 3)
        {
            Session::flash('flash_message_danger', 'Cannot Added Data Again. Contact The Administrator');
            return redirect($redirect_failed);
        }
        else
        {
            DB::beginTransaction();
            try{
                Sosmed::create([
                            'author' => $request->input('authors'),
                            'website_id' => $request->input('website_id'),
                            'name' => $request->input('name'),
                            'url' => $request->input('url'),
                            'status' => 1
                        ]);
                DB::commit();
                Session::flash('flash_message_success', 'Data Has Been Successfully Created');
            }catch (\Exception $e) {
                Session::flash('flash_message_danger', $e->getmessage());
            }
            return redirect($redirect_success);
        }
            
    }

    public function edit($id)
    {
        $sosmed_data = Sosmed::find($id);
        if($sosmed_data)
        {
            return view('backend.pages.content-edit-sosmed',compact('sosmed_data'));
        }
        else
        {
            Session::flash('flash_message_warning', ucfirst(trans('backend/core.data_not_found')));
            return redirect(url(env('BACKEND_ROUTE').'/setting/social/media'));
        }
    }


    public function update(Request $request, $id)
    {
        $sosmed_data = $request->except('_token');
        $sosmedlist = Sosmed::find($id);
        DB::beginTransaction();
        try{
            $redirect_failed = url(env('BACKEND_ROUTE').'/setting/social/media/edit/'.$id);
            $redirect_success = url(env('BACKEND_ROUTE').'/setting/social/media');
    
            $sosmedlist->update($sosmed_data);

           DB::commit();

           Session::flash('flash_message_success', 'Data Has Been Successfully Updated');
           return redirect($redirect_success);
        }catch(Exception $e){
            Session::flash('flash_message_danger', $e->getmessage());
            DB::rollback();
            throw $e;
        }
    }

    public function delete($id)
    {
        if($object = Sosmed::find($id))
        {
            $object->delete();    
        }
        
    	Session::flash('flash_message_success', 'Product Coupon Has Been Successfully Deleted');
        return redirect(url(env('BACKEND_ROUTE').'/setting/social/media'));
    }
}
