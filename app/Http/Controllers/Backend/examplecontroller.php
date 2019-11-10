<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Database\Schema\Blueprint;
use App\Http\Controllers\Controller;
use App\Component\Datatable\DataTable;

use Validator;
use Session;
use Schema;
use Config;
use Route;
use Auth;
use File;
use Lang;
use DB;

use App\SysSetting;
use App\Traits\ContentData;
use App\Locations;
use App\LocationsContentData;

class LocationsController extends BackendController
{
    use ContentData;
    
        function __construct(Request $request, Route $route)
        {
            // Load content setting from config file
            $this->load_content_setting();
    
            $content_type = $request->get('content_type');
    
            if(array_key_exists($content_type, $this->content_settings))
            {
                // Module identifier must be lowercase and using '_' as a infix
                $module['id'] =  $this->content_settings[$content_type]['module_id'];
    
                // Module name
                $module['name'] = ucwords( $this->content_settings[$content_type]['module_name']);
    
                // Module privileges. 'function_name' => 'privilege type'
                $module['action'] =  $this->content_settings[$content_type]['module_action'];
    
                parent::__construct($request, $route, $module);
            }
            else parent::__construct($request, $route, '');
        }
    
    
        public function index()
        {
            $type = $this->request->get('content_type');
            $cs = $this->content_settings[$type];
    
            $locations = DB::table('content_flat_locations')->get();
    
            return view(
                    'backend.pages.content-listing-'.$cs['template'],
                    compact('cs','type','locations')
            );
        }
    
        public function create()
        {
            $type = $this->request->get('content_type');
            $website = 0;
            $edit = 0;

            if(!array_key_exists($type, $this->content_settings))
            {
                Session::flash('flash_message_warning', ucfirst(trans('backend/core.invalid_request')));
                return redirect(url(env('BACKEND_ROUTE').'/dashboard'));
            }
            else
            {
                $action['cancel'] = url(env('BACKEND_ROUTE').'/location/listing?content_type='.$type);
                $action['preview'] = url(env('BACKEND_ROUTE').'/location/preview?website='.$website);
                $cs = $this->content_settings[$type];
                return view(
                    'backend.pages.content-create-'.$cs['template'],
                    compact('cs','type','action','website','edit')
                );
            }
        }
    
        public function store(Request $request)
        {
            $redirect_failed = url(env('BACKEND_ROUTE').'/location/create?content_type='.$request->input('type'));
            $redirect_success = url(env('BACKEND_ROUTE').'/location/edit?content_type='.$request->input('type'));
    
            // Data Validation
            $validator_rules = $this->build_validator_rule($request->all());
            $validator = Validator::make($request->all(), $validator_rules['rules'], $validator_rules['message']);
            if ($validator->fails()) return redirect($redirect_failed)->withErrors($validator)->withInput();
    
            // Populate Form Data
            $content_data = $this->populate_content_data($request->all());
            //dd($content_data);
    
            // Store file if user upload some file
            if(count($content_data['files']) > 0)
            {
                foreach($content_data['files'] as $file_field)
                {
                    $file = $request->file($file_field);
                    $destination_path = $this->content_media_dir.$request->input('type');
                    $file->move($destination_path, $content_data['child'][$file_field]['data']);
                }
            }
    
            // Store Data to Database
            if(count($content_data['parent']) > 0)
            {
                $object = new Locations;
                foreach($content_data['parent'] as $k=>$v)
                {
                    // if($k == 'type') continue;
                    $object->{$k} = $v['data'];
                }
            }
             //dd($object);
            \DB::beginTransaction();
            try
            {
                // dd($content_data);
                if(!Schema::hasTable('content_flat_'.$request->input('type'))) $this->create_content_flat_table($content_data);
                $object->save();
                if(count($content_data['child']) > 0)
                {
                    foreach($content_data['parent'] as $k => $v) $index_data[$k] = $v['data'];
                    foreach($content_data['child'] as $k => $v)
                    {
                        if($k != 'website_id')
                        {
                            $obj = new LocationsContentData;
                            $obj->content_id = $object->id;
                            $obj->website_id = $request->input('website_id');
                            $obj->data_key = $k;
                            $obj->data_value = $v['data'];
                            $obj->save();
                        }
                        $index_data[$k] = $v['data'];
                    }
                    unset($index_data['type']);
                    $index_data['content_id'] = $object->id;
                    $index_data['content_type'] = $request->input('type');
                    $index_data['template'] = $request->input('template');
                }
                \DB::table('content_flat_'.$request->input('type'))->insert($index_data);
                \DB::commit();
                Session::flash('flash_message_success', ucfirst(trans('backend/core.data_saved')));
            }
            catch (\Exception $e)
            {
                \DB::rollback();
                Session::flash('flash_message_danger', $e->getmessage());
                return redirect($redirect_failed)->withInput();
            }
    
            return redirect($redirect_success.'&id='.$object->id.'&website=0');
        }
    
        public function edit()
        {
            $type = $this->request->get('content_type');
            $edit = 1;
    
            if(!array_key_exists($type, $this->content_settings))
            {
                Session::flash('flash_message_warning', ucfirst(trans('backend/core.invalid_request')));
                return redirect(url(env('BACKEND_ROUTE').'/dashboard'));
            }
    
            $id = $this->request->get('id');
            $website = $this->request->get('website');
    
            $object = Locations::find($id);
            if($object)
            {
                $object_data_website = array();
                $object_data_default = LocationsContentData::where('website_id','0')->where('content_id',$object->id)->get();
                if($website != 0) $object_data_website = LocationsContentData::where('website_id',$website)->where('content_id',$object->id)->get();
                if(count($object_data_default) > 0)
                {
                    $object_website = array();
                    if(count($object_data_website) > 0)
                    {
                        foreach($object_data_website as $odw) $object_website[$odw->data_key] = $odw->data_value;
                    }
                    $data = array();
                    foreach($object_data_default as $od)
                    {
                        if(array_key_exists($od->data_key,$object_website)) $data[$od->data_key] = $object_website[$od->data_key];
                        else $data[$od->data_key] = $od->data_value;
                    }
                    $object->data = $data;
                }
                $action['cancel'] = url(env('BACKEND_ROUTE').'/location/listing?content_type='.$type);
                $action['preview'] = url(env('BACKEND_ROUTE').'/location/preview?id='.$object->id.'&website='.$website);
                $action['delete'] = url(env('BACKEND_ROUTE').'/location/delete/'.$object->id);
                $cs = $this->content_settings[$type];
                return view(
                    'backend.pages.content-edit-'.$cs['template'],
                    compact('cs','type','action','id','website','object','object_website','edit')
                );
            }
            else
            {
                Session::flash('flash_message_warning', ucfirst(trans('backend/core.data_not_found')));
                return redirect(url(env('BACKEND_ROUTE').'/location/listing?content_type='.$type));
            }
        }
    
        public function update(Request $request)
        {
            if($request->input('object_id') && $request->input('website_id') != '')
            {
                $id = $request->input('object_id');
                $website = $request->input('website_id');
    
                $object = Locations::find($id);
                if($object)
                {
                    $type = $object->type;
                    $redirect_success = $redirect_failed = url(env('BACKEND_ROUTE').'/location/edit?content_type='.$type.'&id='.$id.'&website='.$website);
    
                    // Data Validation
                    $validator_rules = $this->build_validator_rule($request->all());
                    $validator = Validator::make($request->all(), $validator_rules['rules'], $validator_rules['message']);
                    if ($validator->fails()) return redirect($redirect_failed)->withErrors($validator)->withInput();
    
                    // Populate Form Data
                    $content_data = $this->populate_content_data($request->all(), true);
    
                    // Store file if user upload some file
                    if(count($content_data['files']) > 0)
                    {
                        foreach($content_data['files'] as $file_field)
                        {
                            // Delete old file if exist
                            $this->delete_file($website, $id, $request->input('type'), $file_field);
    
                            // Store new file
                            $file = $request->file($file_field);
                            $destination_path = $this->content_media_dir.$request->input('type');
                            $file->move($destination_path, $content_data['child'][$file_field]['data']);
                        }
                    }
    
                    // If user remove some files
                    if(count($content_data['removed_file']) > 0)
                    {
                        foreach($content_data['removed_file'] as $k => $add_field)
                        {
                            $this->delete_file($website, $id, $request->input('type'), $k);
                        }
                    }
    
                    // Set fields those same as default value
                    if($website != '0')
                    {
                        $default_field_list = json_decode($request->input('default_field_list'),true);
                        foreach($default_field_list as $dfl)
                        {
                            LocationsContentData::where('content_id',$id)->where('website_id',$website)->where('data_key',$dfl)->delete();
                        }
                    }
    
                    // Store Data to Database
                    if(count($content_data['parent']) > 0)
                    {
                        foreach($content_data['parent'] as $k=>$v) $object->{$k} = $v['data'];
                    }
                    \DB::beginTransaction();
                    try
                    {
                        $object->save();
                        if(count($content_data['child']) > 0)
                        {
                            foreach($content_data['parent'] as $k => $v) $index_data[$k] = $v['data'];
                            foreach($content_data['child'] as $k => $v)
                            {
                                if($k != 'website_id')
                                {
                                    if($website == '0')
                                    {
                                        $obj = LocationsContentData::where('content_id',$id)->where('website_id',$website)->where('data_key',$k)->first();
                                        if($obj)
                                        {
                                            $obj->data_key = $k;
                                            $obj->data_value = $v['data'];
                                            $obj->save();
                                        }
                                        else
                                        {
                                            $obj = new LocationsContentData;
                                            $obj->content_id = $object->id;
                                            $obj->website_id = $request->input('website_id');
                                            $obj->data_key = $k;
                                            $obj->data_value = $v['data'];
                                            $obj->save();
                                        }
                                    }
                                    else
                                    {
                                        if(
                                            array_key_exists($k,$request->all())
                                            OR array_key_exists($k,$content_data['removed_file'])
                                            OR ($v['type'] == 'switch' && !in_array($k,$default_field_list))
                                        )
                                        {
                                            $obj = LocationsContentData::where('content_id',$id)->where('website_id',$website)->where('data_key',$k)->first();
                                            if($obj)
                                            {
                                                $obj->data_key = $k;
                                                $obj->data_value = $v['data'];
                                                $obj->save();
                                            }
                                            else
                                            {
                                                $obj = new LocationsContentData;
                                                $obj->content_id = $object->id;
                                                $obj->website_id = $request->input('website_id');
                                                $obj->data_key = $k;
                                                $obj->data_value = $v['data'];
                                                $obj->save();
                                            }
                                        }
                                    }
                                }
                                $index_data[$k] = $v['data'];
                            }
                            unset($index_data['type']);
                            $index_data['content_id'] = $object->id;
                            $index_data['content_type'] = $request->input('type');
                            $index_data['template'] = $request->input('template');
                        }
    
                        // Prepare data to store in flat table
                        $object_data_default = LocationsContentData::where('website_id','0')->where('content_id',$object->id)->get();
                        if($website == '0')
                        {
                            foreach($object_data_default as $od)
                            {
                                if(!array_key_exists($od->data_key,$index_data)) $index_data[$od->data_key] = $od->data_value;
                            }
                        }
                        else
                        {
                            foreach($object_data_default as $od)
                            {
                                if(in_array($od->data_key,$default_field_list)) $index_data[$od->data_key] = $od->data_value;
                                elseif(!array_key_exists($od->data_key,$index_data)) $index_data[$od->data_key] = $od->data_value;
                            }
                        }
                        $object_flat_data = \DB::table('content_flat_'.$request->input('type'))->where('content_id',$id)->where('website_id',$website)->count();
                        if($object_flat_data == 0) \DB::table('content_flat_'.$request->input('type'))->insert($index_data);
                        else \DB::table('content_flat_'.$request->input('type'))->where('content_id',$id)->where('website_id',$website)->update($index_data);
                        \DB::commit();
                        Session::flash('flash_message_success', ucfirst(trans('backend/core.data_saved')));
                    }
                    catch (\Exception $e)
                    {
                        \DB::rollback();
                        Session::flash('flash_message_danger', $e->getmessage());
                        return redirect($redirect_failed)->withInput();
                    }
    
                    return redirect($redirect_success);
                }
                else
                {
                    Session::flash('flash_message_danger', ucfirst(trans('backend/core.data_not_found')));
                    return redirect(url(env('BACKEND_ROUTE').'/dashboard'));
                }
            }
            else
            {
                Session::flash('flash_message_danger', ucfirst(trans('backend/core.data_not_valid')));
                return redirect(url(env('BACKEND_ROUTE').'/dashboard'));
            }
    
        }
    
        public function delete($id)
        {
            if($object = Locations::find($id))
            {

                $redirect_success = $redirect_failed = url(env('BACKEND_ROUTE').'/location/listing?content_type='.$object->type);

                \DB::beginTransaction();
                try
                {
                    // Delete all files those related with this content
                    $file_fields = $this->get_file_fields($object->type);
                    if(count($file_fields) > 0)
                    {
                        foreach(config('sys.website') as $website)
                        {
                            foreach($file_fields as $file_field)
                            {
                                $this->delete_file($website->id, $id, $object->type, $file_field);
                            }
                        }
                    }
    
                    // Delete database data
                    \DB::table('content_flat_'.$object->type)->where('content_id',$id)->delete();
                    LocationsContentData::where('content_id',$id)->delete();
                    $object->delete();
                    \DB::commit();
                    Session::flash('flash_message_success', ucfirst(trans('backend/core.data_deleted')));
                }
                catch (\Exception $e)
                {
                    \DB::rollback();
                    Session::flash('flash_message_danger', $e->getmessage());
                    return redirect($redirect_failed);
                }
                return redirect($redirect_success);
            }
            else
            {
                Session::flash('flash_message_danger', ucfirst(trans('backend/core.data_not_valid')));
                return redirect(url(env('BACKEND_ROUTE').'/dashboard'));
            }
        }
}
