<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;

use Validator;
use Session;
use Route;

use App\SysContent;
use App\SysContentData;


class ContentPageDefaultController extends BackendController
{


    function __construct(Request $request, Route $route)
    {
        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'content_page_default';
        $module['name'] = ucwords(trans('backend/core.default_page'));
        $module['action'] = array(
            'create' => 'create',
            'store' => 'create',
            'edit' => 'edit',
            'update' => 'edit',
            'delete' => 'delete',
        );

        parent::__construct($request, $route, $module);
    }


    public function create()
    {
        return view('backend.pages.page-default-create');
    }

    
    public function store(Request $request)
    {
        $fields = [
            'template' => 'required',
    		'title' => 'required',
            'subtitle' => 'string',
    		'url' => 'bail|required|unique:pages,url',
    		'status' => 'required|in:0,1',
            'meta_title' => 'string',
            'meta_description' => 'string',
    	];

        $message = [];

        $validator = Validator::make($request->all(), $fields, $message);

        
        $redirect_failed = url(env('BACKEND_ROUTE').'/pages/create');
        $redirect_success = url(env('BACKEND_ROUTE').'/pages');
        
        if ($validator->fails()) return redirect($redirect_failed)->withErrors($validator)->withInput();

        $object = new Pages;
        $object->created_by = 1;
        $object->modified_by = 1;
        foreach($fields as $k=>$v) $object->{$k} = $request->input($k);

        \DB::beginTransaction();
        try {
            $object->save();
            if($request->input('box_title'))
            {
                for($i=0; $i<count($request->input('box_title')); $i++)
                {
                    $obj = new PagesBox;
                    $obj->page_id = $object->id;
                    $obj->title = $request->input('box_title.'.$i);
                    $obj->content = $request->input('box_content.'.$i);
                    $obj->save();
                }
            }
            \DB::commit();
            Session::flash('flash_message_success', ucfirst(trans('backend/core.page_created')));
        } catch (\Exception $e) {
            \DB::rollback();
            Session::flash('flash_message_danger', $e->getmessage());
        }

        return redirect($redirect_success);
    }


    public function edit($id)
    {
        $template = PagesTemplate::all();
        $object = Pages::find($id);
        if($object) return view('backend.pages.page_edit',['object' => $object, 'template' => $template]);
        else
        {
            Session::flash('flash_message_warning', ucfirst(trans('backend/core.data_not_found')));
            return redirect(url(env('BACKEND_ROUTE').'/pages'));
        }
    }


    public function update(Request $request)
    {
        if($request->input('object_id'))
        {   
            $object = Pages::find($request->input('object_id'));
            if($object)
            {
                $fields = [
                    'template' => 'required',
                    'title' => 'required',
                    'subtitle' => 'string',
                    'url' => 'bail|required|unique:pages,url,'.$object->id,
                    'status' => 'required|in:0,1',
                    'meta_title' => 'string',
                    'meta_description' => 'string',
                ];

                $message = [];

                $validator = Validator::make($request->all(), $fields, $message);

                $redirect_failed = url(env('BACKEND_ROUTE').'/pages/edit/'.$request->input('object_id'));
                $redirect_success = url(env('BACKEND_ROUTE').'/pages');
                
                if ($validator->fails()) return redirect($redirect_failed)->withErrors($validator)->withInput();
                
                foreach($fields as $k=>$v) $object->{$k} = $request->input($k);
            
                \DB::beginTransaction();
                try {
                    $object->save();
                    PagesBox::where('page_id',$request->input('object_id'))->delete();
                    if($request->input('box_title'))
                    {
                        for($i=0; $i<count($request->input('box_title')); $i++)
                        {
                            $obj = new PagesBox;
                            $obj->page_id = $request->input('object_id');
                            $obj->title = $request->input('box_title.'.$i);
                            $obj->content = $request->input('box_content.'.$i);
                            $obj->save();
                        }
                    }
                    \DB::commit();
                    Session::flash('flash_message_success', ucfirst(trans('backend/core.page_updated')));
                } catch (\Exception $e) {
                    \DB::rollback();
                    Session::flash('flash_message_danger', $e->getmessage());
                }
            }
            else
            {
                Session::flash('flash_message_warning', ucfirst(trans('backend/core.data_not_found')));
                return redirect(url(env('BACKEND_ROUTE').'/pages'));
            }
        }
        else
        {
            Session::flash('flash_message_danger', ucfirst(trans('backend/core.data_not_valid')));
            return redirect(url(env('BACKEND_ROUTE').'/pages'));
        }

        return redirect($redirect_success);
    }


    public function delete($id)
    {
        if($object = Pages::find($id))
        {
            PagesBox::where('page_id',$id)->delete();
            $object->delete();    
        }
        
    	Session::flash('flash_message_success', ucfirst(trans('backend/core.page_deleted')));
        return redirect(url(env('BACKEND_ROUTE').'/pages'));
    }

}