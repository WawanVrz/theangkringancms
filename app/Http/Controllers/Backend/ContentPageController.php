<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;

use Validator;
use Session;
use Route;
use Auth;

use App\SysContent;
use App\SysContentData;


class ContentPageController extends BackendController
{


    function __construct(Request $request, Route $route)
    {
        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'content_page';
        
        // Module name
        $module['name'] = ucwords(trans('backend/core.cms_page'));
        
        // Module privileges. 'function_name' => 'privilege type'
        $module['action'] = array(
            'index' => 'index',
            'create' => 'create',
            'create_default' => 'create',
            'create_neutral' => 'create',
            'store' => 'create',
            'edit' => 'edit',
            'update' => 'edit',
            'delete' => 'delete',
        );

        parent::__construct($request, $route, $module);
    }


    public function index()
    {
        $object = Pages::all();
        return view('backend.pages.page',['object' => $object]);
    }


    public function create($page_type = '')
    {
        if($page_type == '') $page_type = 'default';
        $func = 'create_'.$page_type;
        return $this->$func();
    }


    private function create_default()
    {
        $action['cancel'] = url(env('BACKEND_ROUTE').'/pages');
        $action['preview'] = url(env('BACKEND_ROUTE').'/preview');
        return view('backend.pages.page-create-default',compact('action'));
    }
    
    
    private function create_neutral()
    {
        echo 'neutral';
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $fields = [
            'type' => 'required',    		
            'status' => 'required|in:0,1',
    		'title' => 'required',    		
            'excerpt' => 'string',    		
            'content' => 'string',    	
            'template' => 'string',    	
            'order' => 'integer',    	
        ];
        
        $message = [];
        
        $validator = Validator::make($request->all(), $fields, $message);

        $redirect_failed = url(env('BACKEND_ROUTE').'/pages/create');
        $redirect_success = url(env('BACKEND_ROUTE').'/pages/create');
        
        if ($validator->fails()) return redirect($redirect_failed)->withErrors($validator)->withInput();

        $object = new SysContent;
        $object->author = Auth::user()->id;
        if($request->input('publish_time') != 0) $object->publish_time = $request->input('publish_time');
        
        // -- need moderation -- //
        if($request->input('slug') == '') $object->slug = str_slug($request->input('title'), '-'); 
        else $object->slug = str_slug($request->input('slug'), '-'); 
        // -- need moderation -- //

        foreach($fields as $k=>$v) $object->{$k} = $request->input($k);

        \DB::beginTransaction();
        try {
            $object->save();
            $content_data_list = array(
                                    'featured_image',
                                    'featured_image_title',
                                    'featured_image_alt_text',
                                    'images_gallery',
                                    'featured_video_used',
                                    'featured_video_external',
                                    'featured_video_internal',
                                    'meta_title',
                                    'meta_description',
                                    'meta_keywords',
                                    'canonical_url',
                                    'meta_robots_index',
                                    'meta_robots_follow',
                                );
            foreach($content_data_list as $cdl)
            {
                if($request->input($cdl))
                {
                    $obj = new SysContentData;
                    $obj->content_id = $object->id;
                    $obj->website_id = $request->input('website_id');
                    $obj->data_key = $cdl;
                    $obj->data_value = $request->input($cdl);
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


    public function store2(Request $request)
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
        $object = SysContent::find($id);
        if($object){
            $object_data = SysContentData::where('website_id','0')->where('content_id',$object->id)->get();
            if(count($object_data) > 0)
            {
                $data = array();
                foreach($object_data as $od) $data[$od->data_key] = $od->data_value;
            }
            $object->data = $data;
            $action['cancel'] = url(env('BACKEND_ROUTE').'/pages');
            $action['preview'] = url(env('BACKEND_ROUTE').'/preview');
            $action['delete'] = url(env('BACKEND_ROUTE').'/pages/delete/'.$object->id);
            return view('backend.pages.page-edit-default',compact('object','action'));
        }
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
            $object = SysContent::find($request->input('object_id'));
            if($object)
            {
                // dd($request->all());
                $fields = [
                    'type' => 'required',    		
                    'status' => 'required|in:0,1',
                    'title' => 'required',    		
                    'excerpt' => 'string',    		
                    'content' => 'string',    	
                    'template' => 'string',    	
                    'order' => 'integer',    	
                ];
                
                $message = [];
                
                $validator = Validator::make($request->all(), $fields, $message);

                $redirect_failed = url(env('BACKEND_ROUTE').'/pages/edit');
                $redirect_success = url(env('BACKEND_ROUTE').'/pages/create');
                
                if ($validator->fails()) return redirect($redirect_failed)->withErrors($validator)->withInput();

                $object = new SysContent;
                $object->author = Auth::user()->id;
                if($request->input('publish_time') != 0) $object->publish_time = $request->input('publish_time');
                
                // -- need moderation -- //
                if($request->input('slug') == '') $object->slug = str_slug($request->input('title'), '-'); 
                else $object->slug = str_slug($request->input('slug'), '-'); 
                // -- need moderation -- //

                foreach($fields as $k=>$v) $object->{$k} = $request->input($k);

                \DB::beginTransaction();
                try {
                    $object->save();
                    $content_data_list = array(
                                            'featured_image',
                                            'featured_image_title',
                                            'featured_image_alt_text',
                                            'images_gallery',
                                            'featured_video_used',
                                            'featured_video_external',
                                            'featured_video_internal',
                                            'meta_title',
                                            'meta_description',
                                            'meta_keywords',
                                            'canonical_url',
                                            'meta_robots_index',
                                            'meta_robots_follow',
                                        );
                    foreach($content_data_list as $cdl)
                    {
                        if($request->input($cdl))
                        {
                            $obj = new SysContentData;
                            $obj->content_id = $object->id;
                            $obj->website_id = $request->input('website_id');
                            $obj->data_key = $cdl;
                            $obj->data_value = $request->input($cdl);
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
    }


    public function update2(Request $request)
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