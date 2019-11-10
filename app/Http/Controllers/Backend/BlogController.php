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
use App\SysLogging;
use App\Blogs;
use App\BlogsContentData;
use App\ContentRelation;
use App\ContentRelationProduct;
use App\ContentFlatPost;
use App\SysSetting;
use App\Traits\ContentData;

class BlogController extends BackendController
{
    use ContentData;
    private $dir_picture = 'media/upload/filemanager/blog';


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

        $page = DB::table('content_flat_post')->where('website_id','=','0')->get();

        return view(
                'backend.pages.content-listing-'.$cs['template'],
                compact('cs','type','page')
        );
    }

    public function category_index()
    {
        $type = $this->request->get('content_type');
        $cs = $this->content_settings[$type];

        $page = DB::table('content_flat_category_post')->where('website_id','=','0')->get();

        return view(
                'backend.pages.content-listing-'.$cs['template'],
                compact('cs','type','page')
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
            $action['cancel'] = url(env('BACKEND_ROUTE').'/content/blog/category/listing?content_type='.$type);
            $action['preview'] = url(env('BACKEND_ROUTE').'/content/blog/category/preview?website='.$website);
            $cs = $this->content_settings[$type];
            return view(
                'backend.pages.content-create-'.$cs['template'],
                compact('cs','type','action','website','edit')
            );
        }
    }

    public function category_create()
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
            $action['cancel'] = url(env('BACKEND_ROUTE').'/content/blog/category/listing?content_type='.$type);
            $action['preview'] = url(env('BACKEND_ROUTE').'/content/blog/category/preview?website='.$website);
            $cs = $this->content_settings[$type];
            return view(
                'backend.pages.content-create-'.$cs['template'],
                compact('cs','type','action','website','edit')
            );
        }
    }

    public function store(Request $request)
    {
        $redirect_failed = url(env('BACKEND_ROUTE').'/content/blog/create?content_type='.$request->input('type'));
        $redirect_success = url(env('BACKEND_ROUTE').'/content/blog/edit?content_type='.$request->input('type'));

        // Data Validation
        $validator_rules = $this->build_validator_rule($request->all());
        $validator = Validator::make($request->all(), $validator_rules['rules'], $validator_rules['message']);
        if ($validator->fails()) return redirect($redirect_failed)->withErrors($validator)->withInput();
        
        // Populate Form Data
        $content_data = $this->populate_content_data($request->all());

        //  dd($content_data);

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
            $object = new Blogs;
            foreach($content_data['parent'] as $k=>$v) 
            {
                //if($k == 'type') continue;
                $object->{$k} = $v['data'];
            }
        }
        \DB::beginTransaction();
        try 
        {   
            unset($content_data['child']['content_type']);
            if(!Schema::hasTable('content_flat_'.$request->input('type'))) $this->create_content_flat_table($content_data); 
            $object->save();
            if(count($content_data['child']) > 0)
            {
                foreach($content_data['parent'] as $k => $v) $index_data[$k] = $v['data'];
                foreach($content_data['child'] as $k => $v)
                {
                    if($k == 'category_id') continue;
                    if($k != 'website_id')
                    {
                        $obj = new BlogsContentData;
                        $obj->content_id = $object->id;
                        $obj->website_id = $request->input('website_id');
                        $obj->data_key = $k;
                        if($k == 'slug')
                        {
                            if($v['data'] == '' OR $v['data'] == NULL)
                            {
                                $slug = str_slug($request->input('title'), '-');
                                if(Schema::hasTable('flat_data_content_'.$request->input('type')))
                                {
                                    $i = 1;
                                    $new_slug = $slug;
                                    while(true)
                                    {
                                        $exists = \DB::table('flat_data_content_'.$request->input('type'))->where('slug',$new_slug)->count();
                                        if($exists > 0)
                                        {
                                            $i++;
                                            $new_slug = $slug.'-'.$i;
                                        }
                                        else break;
                                    }
                                    $v['data'] = $new_slug;
                                }
                                else $v['data'] = $slug;
                            }
                        }
                        $obj->data_value = $v['data'];
                        $obj->save();

                    }
                    $index_data[$k] = $v['data'];
                }

                // ======== ADD CATEGORY ==========
                $datacategory = json_decode($content_data['child']['category_id']['data'], true);
                if($datacategory != null)
                {
                    foreach($datacategory as $cat)
                    {
                        $detail['relation'] = "blog-relation";
                        $detail['parent_id'] =$object->id;
                        $detail['child_id'] = $cat;
                        ContentRelation::create($detail);
                    }
                }
                else
                {

                }

                // ====== ADD RELATED PRODUCT ======
                $datarelatedproduct = json_decode($content_data['child']['related_id']['data'], true);
                if($datarelatedproduct != null)
                {
                    foreach($datarelatedproduct as $rel)
                    {
                        $detail['relation'] = "product-related-relation";
                        $detail['parent_id'] =$object->id;
                        $detail['child_id'] = $rel;
                        ContentRelationProduct::create($detail);
                    }
                }
                else
                {

                }

                unset($index_data['type']);
                $index_data['content_id'] = $object->id;
                $index_data['content_type'] = $request->input('type');
                $index_data['template'] = $request->input('template');
            }
            \DB::table('content_flat_'.$request->input('type'))->insert($index_data);
            \DB::commit();

            //----- SAVE TO TBL LOG -------
            $links = url("blogs/".$index_data['slug']);
            SysLogging::create([
                'user_id' => Auth::user()->id,
                'fullname' => Auth::user()->username,
                'user_role' => Auth::user()->role_id,
                'status' => 'Create',
                'content_type' => $request->input('type'),
                'website_id' => $request->input('website_id'),
                'url' => $links,
                'notes' => Auth::user()->username.' has created this page : '.$links,
                'ac' => 1
            ]);
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

    public function category_store(Request $request)
    {
        $redirect_failed = url(env('BACKEND_ROUTE').'/content/blog/category/create?content_type='.$request->input('type'));
        $redirect_success = url(env('BACKEND_ROUTE').'/content/blog/category/edit?content_type='.$request->input('type'));

        // Data Validation
        $validator_rules = $this->build_validator_rule($request->all());
        $validator = Validator::make($request->all(), $validator_rules['rules'], $validator_rules['message']);
        if ($validator->fails()) return redirect($redirect_failed)->withErrors($validator)->withInput();
        
        // Populate Form Data
        $content_data = $this->populate_content_data($request->all());

        // dd($content_data);

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
            $object = new Blogs;
            foreach($content_data['parent'] as $k=>$v) 
            {
                //if($k == 'type') continue;
                $object->{$k} = $v['data'];
            }
        }
        \DB::beginTransaction();
        try 
        {   
            unset($content_data['child']['content_type']);
            if(!Schema::hasTable('content_flat_'.$request->input('type'))) $this->create_content_flat_table($content_data); 
            $object->save();
            if(count($content_data['child']) > 0)
            {
                foreach($content_data['parent'] as $k => $v) $index_data[$k] = $v['data'];
                foreach($content_data['child'] as $k => $v)
                {
                    // if($k == 'content_type') continue;
                    if($k != 'website_id')
                    {
                        $obj = new BlogsContentData;
                        $obj->content_id = $object->id;
                        $obj->website_id = $request->input('website_id');
                        $obj->data_key = $k;
                        if($k == 'slug')
                        {
                            if($v['data'] == '' OR $v['data'] == NULL)
                            {
                                $slug = str_slug($request->input('title'), '-');
                                if(Schema::hasTable('flat_data_content_'.$request->input('type')))
                                {
                                    $i = 1;
                                    $new_slug = $slug;
                                    while(true)
                                    {
                                        $exists = \DB::table('flat_data_content_'.$request->input('type'))->where('slug',$new_slug)->count();
                                        if($exists > 0)
                                        {
                                            $i++;
                                            $new_slug = $slug.'-'.$i;
                                        }
                                        else break;
                                    }
                                    $v['data'] = $new_slug;
                                }
                                else $v['data'] = $slug;
                            }
                        }
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

            //----- SAVE TO TBL LOG -------
            $links = url("page/blogs/category/".$index_data['slug']);
            SysLogging::create([
                'user_id' => Auth::user()->id,
                'fullname' => Auth::user()->username,
                'user_role' => Auth::user()->role_id,
                'status' => 'Create',
                'content_type' => $request->input('type'),
                'website_id' => $request->input('website_id'),
                'url' => $links,
                'notes' => Auth::user()->username.' has created this page : '.$links,
                'ac' => 1
            ]);
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
        $products = DB::table('content_flat_product')->where('customized','=',1)->where('content_flat_product.website_id',0)->get();

        $type = $this->request->get('content_type');
        $edit = 1;
        if(!array_key_exists($type, $this->content_settings))
        {
            Session::flash('flash_message_warning', ucfirst(trans('backend/core.invalid_request')));
            return redirect(url(env('BACKEND_ROUTE').'/dashboard'));
        }

        $id = $this->request->get('id');
        $website = $this->request->get('website');

        $object = Blogs::find($id);
        if($object)
        {
            $object_data_website = array();
            $object_data_default = BlogsContentData::where('website_id','0')->where('content_id',$object->id)->get();
            if($website != 0) $object_data_website = BlogsContentData::where('website_id',$website)->where('content_id',$object->id)->get();
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
            $action['cancel'] = url(env('BACKEND_ROUTE').'/content/seo/listing?content_type='.$type);
            $action['preview'] = url(env('BACKEND_ROUTE').'/content/seo/preview?id='.$object->id.'&website='.$website);
            $action['delete'] = url(env('BACKEND_ROUTE').'/content/seo/delete/'.$object->id);
            $cs = $this->content_settings[$type];

            $bogcategoryused = DB::table('content_flat_post')
                            ->join('sys_content_relation','sys_content_relation.parent_id','=','content_flat_post.content_id')
                            ->join('content_flat_category_post','content_flat_category_post.content_id','=','sys_content_relation.child_id')
                            ->select('content_flat_category_post.*')
                            ->where('sys_content_relation.relation','=','blog-relation')
                            ->where('sys_content_relation.parent_id',$id)
                            ->where('content_flat_category_post.website_id','0')
                            ->groupby('content_flat_category_post.content_id')
                            ->get();

            $productused = DB::table('content_flat_post')
                            ->join('sys_content_relation_product','sys_content_relation_product.parent_id','=','content_flat_post.content_id')
                            ->join('content_flat_product','content_flat_product.content_id','=','sys_content_relation_product.child_id')
                            ->select('content_flat_product.*')
                            ->where('sys_content_relation_product.relation','=','product-related-relation')
                            ->where('sys_content_relation_product.parent_id',$id)
                            ->where('content_flat_product.website_id','0')
                            ->groupby('content_flat_product.content_id')
                            ->get();
                            
            return view(
                'backend.pages.content-edit-'.$cs['template'],
                compact('cs','type','action','id','website','object','object_website','edit','products','bogcategoryused','productused')
            );
        }
        else
        {
            Session::flash('flash_message_warning', ucfirst(trans('backend/core.data_not_found')));
            return redirect(url(env('BACKEND_ROUTE').'/content/seo/listing?content_type='.$type));
        }
    }

    public function category_edit()
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

        $object = Blogs::find($id);
        if($object)
        {
            $object_data_website = array();
            $object_data_default = BlogsContentData::where('website_id','0')->where('content_id',$object->id)->get();
            if($website != 0) $object_data_website = BlogsContentData::where('website_id',$website)->where('content_id',$object->id)->get();
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
            $action['cancel'] = url(env('BACKEND_ROUTE').'/content/blog/category/listing?content_type='.$type);
            $action['preview'] = url(env('BACKEND_ROUTE').'/content/blog/category/preview?id='.$object->id.'&website='.$website);
            $action['delete'] = url(env('BACKEND_ROUTE').'/content/blog/category/delete/'.$object->id);
            $cs = $this->content_settings[$type];
            return view(
                'backend.pages.content-edit-'.$cs['template'],
                compact('cs','type','action','id','website','object','object_website','edit')
            );
        }
        else
        {
            Session::flash('flash_message_warning', ucfirst(trans('backend/core.data_not_found')));
            return redirect(url(env('BACKEND_ROUTE').'/content/blog/category/listing?content_type='.$type));
        }
    }

    public function update(Request $request)
    {
        if($request->input('object_id') && $request->input('website_id') != '')
        {
            $id = $request->input('object_id');
            $website = $request->input('website_id');

            $object = Blogs::find($id);
            //dd($object);

            if($object)
            {
                $type = $object->type;
                $redirect_success = $redirect_failed = url(env('BACKEND_ROUTE').'/content/blog/edit?content_type='.$type.'&id='.$id.'&website='.$website);
                
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
                        BlogsContentData::where('content_id',$id)->where('website_id',$website)->where('data_key',$dfl)->delete();
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
                            if($k == 'category_id') continue;
                            if($k != 'website_id')
                            {
                                if($website == '0')
                                {
                                    $obj = BlogsContentData::where('content_id',$id)->where('website_id',$website)->where('data_key',$k)->first();
                                    if($obj)
                                    {
                                        $obj->data_key = $k;
                                        $obj->data_value = $v['data'];
                                        $obj->save();
                                    }
                                    else
                                    {
                                        $obj = new BlogsContentData;
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
                                        $obj = BlogsContentData::where('content_id',$id)->where('website_id',$website)->where('data_key',$k)->first();
                                        if($obj)
                                        {
                                            $obj->data_key = $k;
                                            $obj->data_value = $v['data'];
                                            $obj->save();
                                        }
                                        else
                                        {
                                            $obj = new BlogsContentData;
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

                        // ==== UPDATE CATEGORY ======
                        $datacategory = json_decode($content_data['child']['category_id']['data'], true);
                        if($datacategory != null)
                        {
                            ContentRelation::where('parent_id', $id)->delete();
                            foreach($datacategory as $cat)
                            {
                                $detail['relation'] = "blog-relation";
                                $detail['parent_id'] =$id;
                                $detail['child_id'] = $cat;
                                ContentRelation::create($detail);
                            }
                        }
                        else
                        {

                        }

                        // ==== UPDATE RELATED PRODUCT ======
                        $datarelatedproduct = json_decode($content_data['child']['related_id']['data'], true);
                        if($datarelatedproduct != null)
                        {
                            ContentRelationProduct::where('parent_id', $id)->delete();
                            foreach($datarelatedproduct as $rel)
                            {
                                $detail['relation'] = "product-related-relation";
                                $detail['parent_id'] =$id;
                                $detail['child_id'] = $rel;
                                ContentRelationProduct::create($detail);
                            }
                        }
                        else
                        {

                        }
                        
                        unset($index_data['type']);
                        $index_data['content_id'] = $object->id;
                        $index_data['content_type'] = $request->input('type');
                        $index_data['template'] = $request->input('template');
                    }

                    // Prepare data to store in flat table
                    $object_data_default = BlogsContentData::where('website_id','0')->where('content_id',$object->id)->get();
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

                    //----- SAVE TO TBL LOG -------
                    $links = url("blogs/".$index_data['slug']);
                    SysLogging::create([
                        'user_id' => Auth::user()->id,
                        'fullname' => Auth::user()->username,
                        'user_role' => Auth::user()->role_id,
                        'status' => 'Update',
                        'content_type' => $request->input('type'),
                        'website_id' => $request->input('website_id'),
                        'url' => $links,
                        'notes' => Auth::user()->username.' has changed something on the page : '.$links,
                        'ac' => 1
                    ]);
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

    public function category_update(Request $request)
    {
        if($request->input('object_id') && $request->input('website_id') != '')
        {
            $id = $request->input('object_id');
            $website = $request->input('website_id');

            $object = Blogs::find($id);
            //dd($object);

            if($object)
            {
                $type = $object->type;
                $redirect_success = $redirect_failed = url(env('BACKEND_ROUTE').'/content/blog/category/edit?content_type='.$type.'&id='.$id.'&website='.$website);
                
                // Data Validation
                $validator_rules = $this->build_validator_rule($request->all());
                $validator = Validator::make($request->all(), $validator_rules['rules'], $validator_rules['message']);
                if ($validator->fails()) return redirect($redirect_failed)->withErrors($validator)->withInput();
                
                // Populate Form Data
                $content_data = $this->populate_content_data($request->all(), true);

                // dd($content_data);
        
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
                        BlogsContentData::where('content_id',$id)->where('website_id',$website)->where('data_key',$dfl)->delete();
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
                                    $obj = BlogsContentData::where('content_id',$id)->where('website_id',$website)->where('data_key',$k)->first();
                                    if($obj)
                                    {
                                        $obj->data_key = $k;
                                        $obj->data_value = $v['data'];
                                        $obj->save();
                                    }
                                    else
                                    {
                                        $obj = new BlogsContentData;
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
                                        $obj = BlogsContentData::where('content_id',$id)->where('website_id',$website)->where('data_key',$k)->first();
                                        if($obj)
                                        {
                                            $obj->data_key = $k;
                                            $obj->data_value = $v['data'];
                                            $obj->save();
                                        }
                                        else
                                        {
                                            $obj = new BlogsContentData;
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
                    $object_data_default = BlogsContentData::where('website_id','0')->where('content_id',$object->id)->get();
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

                    //----- SAVE TO TBL LOG -------
                    $links = url("page/blogs/category/".$index_data['slug']);
                    SysLogging::create([
                        'user_id' => Auth::user()->id,
                        'fullname' => Auth::user()->username,
                        'user_role' => Auth::user()->role_id,
                        'status' => 'Update',
                        'content_type' => $request->input('type'),
                        'website_id' => $request->input('website_id'),
                        'url' => $links,
                        'notes' => Auth::user()->username.' has changed something on the page : '.$links,
                        'ac' => 1
                    ]);
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
        if($object = Blogs::find($id))
        {
            $redirect_success = $redirect_failed = url(env('BACKEND_ROUTE').'/content/blog/listing?content_type='.$object->type);
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

                //----- SAVE TO TBL LOG -------
                $dat = \DB::table('content_flat_'.$object->type)->where('content_id',$id)->first();
                $links = url("blogs/".$dat->slug);
                SysLogging::create([
                    'user_id' => Auth::user()->id,
                    'fullname' => Auth::user()->username,
                    'user_role' => Auth::user()->role_id,
                    'status' => 'Delete',
                    'content_type' => $dat->content_type,
                    'website_id' => $dat->website_id,
                    'url' => $links,
                    'notes' => Auth::user()->username.' has deleted this page : '.$links,
                    'ac' => 1
                ]);
                \DB::commit();

                // Delete database data
                \DB::table('content_flat_'.$object->type)->where('content_id',$id)->delete();
                BlogsContentData::where('content_id',$id)->delete();
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

    public function category_delete($id)
    {
        if($object = Blogs::find($id))
        {
            $redirect_success = $redirect_failed = url(env('BACKEND_ROUTE').'/content/blog/category/listing?content_type='.$object->type);
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

                //----- SAVE TO TBL LOG -------
                $dat = \DB::table('content_flat_'.$object->type)->where('content_id',$id)->first();
                $links = url("page/blogs/category/".$dat->slug);
                SysLogging::create([
                    'user_id' => Auth::user()->id,
                    'fullname' => Auth::user()->username,
                    'user_role' => Auth::user()->role_id,
                    'status' => 'Delete',
                    'content_type' => $dat->content_type,
                    'website_id' => $dat->website_id,
                    'url' => $links,
                    'notes' => Auth::user()->username.' has deleted this page : '.$links,
                    'ac' => 1
                ]);
                \DB::commit();

                // Delete database data
                \DB::table('content_flat_'.$object->type)->where('content_id',$id)->delete();
                ContentRelationProduct::where('parent_id',$id)->delete();
                ContentRelation::where('parent_id',$id)->delete();
                BlogsContentData::where('content_id',$id)->delete();
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

    public function setting()
    {
        return view(
            'backend.pages.content-setting',
            ['content_setting' => $this->content_settings]
        );
    }
}