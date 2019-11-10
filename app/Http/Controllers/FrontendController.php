<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Session;
use Auth;
use App;

use App\SysSetting;
use App\SysWebsite;
use App\SysContent;
use App\SysOtherSetting;
use App\Course;
use App\Product;

class FrontendController extends Controller
{

    protected $request;
    protected $route;
    protected $menu;


    function __construct($request, $route)
    {
        // Request & Route initialization
        $this->request = $request;
        $this->route = $route;

        $this->middleware(function ($request, $next) {

            $base_url = url('');
            $website_scope = SysSetting::where('active','1')->where('key','base_url')->where('value',$base_url)->first();
            if($website_scope) Session::put('sys_website_scope', $website_scope->website_id);
            else Session::put('sys_website_scope', 0);
            // $web_id = web_id_by_lang(app()->getLocale());
            // Session::put('sys_website_scope', $web_id);

            // Load website list
            $sys_website = SysWebsite::all();
            config(['sys.website' => $sys_website]);

            // Load website Other Setting
            $sysothersetting_data = SysOtherSetting::all();
            config(['sys.othersetting' => $sysothersetting_data]);

            // Multi website param reset
            Session::put('website_switch_param', '');
            Session::put('content_switch_param', '');

            // Load core system settings
            $sys_setting = SysSetting::where('active','1')->where('website_id',Session::get('sys_website_scope'))->get();
            //$sys_setting = SysSetting::where('active','1')->where('website_id',$web_id)->get();
            foreach($sys_setting as $ss) config(['sys.setting.'.$ss->key => $ss->value]);

            // Locale
            $locale = SysWebsite::find(Session::get('sys_website_scope'))->locale;
            App::setLocale($locale);

            // Menu List
            $slug_prefix = json_decode(config('sys.setting.slug_prefix'),true);
            $menus = json_decode(config('sys.setting.menu'),true);
            if(count($menus) > 0)
            {
                foreach($menus as $k => $menu)
                {
                    $menus_data = []; 
                    $menus_item1 = [];
                    $i = 0;
                    $menu_tree = json_decode($menu['tree'],true);

                    if(count($menu_tree['children']) > 0)
                    {
                        foreach($menu_tree['children'] as $child)
                        {
                            
                            if($child['data']['type'] == 'page')
                            {
                                $object = SysContent::getId($child['data']['id']);
                                $menus_data[$i]['label'] = $child['title'];
                                if($object)
                                {
                                    if($slug_prefix[$object->type] == '')
                                    {
                                        if($object->data['slug'] == '/' OR $object->data['slug'] == '') $slug = '';
                                        else $slug = '/'.$object->data['slug'];
                                    }
                                    else $slug = '/'.$slug_prefix[$object->type].'/'.$object->data['slug'];
                                    $menus_data[$i]['url'] = url($slug);
                                }
                                else $menus_data[$i]['url'] = url('');
                            }
                            elseif ($child['data']['type'] == 'product') 
                            {
                                $object = Product::getId($child['data']['id']);
                                $menus_data[$i]['label'] = $child['title'];
                                if($object)
                                {
                                    if($slug_prefix[$object->type] == '')
                                    {
                                        if($object->data['slug'] == '/' OR $object->data['slug'] == '') $slug = '';
                                        else $slug = '/'.$object->data['slug'];
                                    }
                                    else $slug = '/'.$slug_prefix[$object->type].'/'.$object->data['slug'];
                                    $menus_data[$i]['url'] = url($slug);
                                }
                                else $menus_data[$i]['url'] = url('');
                            }
                            else
                            {
                                if(isset($child['children']))
                                {
                                    foreach($child['children'] as $childitems)
                                    {
                                        if($childitems['data']['type'] == 'page')
                                        {
                                            $object = SysContent::getId($childitems['data']['id']);
                                            $menus_data[$i]['label'] = $childitems['title'];
                                            if($object)
                                            {
                                                if($slug_prefix[$object->type] == '')
                                                {
                                                    if($object->data['slug'] == '/' OR $object->data['slug'] == '') $slug = '';
                                                    else $slug = '/'.$object->data['slug'];
                                                }
                                                else $slug = '/'.$slug_prefix[$object->type].'/'.$object->data['slug'];
                                                $menus_data[$i]['url'] = url($slug);
                                            }
                                            else $menus_data[$i]['url'] = url('');
                                        }
                                        elseif ($childitems['data']['type'] == 'product') 
                                        {
                                            $object = Product::getId($childitems['data']['id']);
                                            $menus_data[$i]['label'] = $childitems['title'];
                                            if($object)
                                            {
                                                if($slug_prefix[$object->type] == '')
                                                {
                                                    if($object->data['slug'] == '/' OR $object->data['slug'] == '') $slug = '';
                                                    else $slug = '/'.$object->data['slug'];
                                                }
                                                else $slug = '/'.$slug_prefix[$object->type].'/'.$object->data['slug'];
                                                $menus_data[$i]['url'] = url($slug);
                                            }
                                            else $menus_data[$i]['url'] = url('');
                                        }
                                        else
                                        {
                                            $menus_item2 = [];
                                            if(isset($childitems['children']))
                                            {
                                                foreach($childitems['children'] as $childsubitems)
                                                {
                                                    $menus_item3 = [];
                                                    if(isset($childitems['children']))
                                                    {
                                                        foreach($childsubitems['children'] as $items)
                                                        {
                                                            if(isset($items['children']))
                                                            {
                                                                $menus_item3[] = [
                                                                    'label' =>  $items['title'],
                                                                    'url' => $items['data']['url'],
                                                                ];
                                                            }
                                                            else
                                                            {
                                                                if(isset($items['data']['icons']))
                                                                {
                                                                    $icons = $items['data']['icons'];
                                                                }
                                                                else 
                                                                {
                                                                    $icons = '';
                                                                }

                                                                $menus_item3[] = [
                                                                    'label' =>  $items['title'],
                                                                    'url' => $items['data']['url'],
                                                                    'icon' => $icons,
                                                                ];
                                                            }
                                                        }

                                                        $menus_item2[] = [
                                                            'label' =>  $childsubitems['title'],
                                                            'url' => $childsubitems['data']['url'],
                                                            'items' => $menus_item3,
                                                        ];
                                                    }
                                                }

                                                $menus_item1[] = [
                                                    'label' =>  $childitems['title'],
                                                    'url' => $childitems['data']['url'],
                                                    'subsubitem' => $menus_item2,
                                                ];
                                            }
                                        }
                                    }

                                    $menus_data[$i]['label'] = $child['title'];
                                    if($child['data']['url'] == '')
                                    {
                                        $menus_data[$i]['url'] = url($child['data']['url']);
                                    }
                                    else 
                                    {
                                        $menus_data[$i]['url'] = $child['data']['url'];
                                    }
                                    $menus_data[$i]['subitem'] = $menus_item1;
                                }
                                else
                                {
                                    $menus_data[$i]['label'] = $child['title'];
                                    if($child['data']['url'] == '')
                                    {
                                        $menus_data[$i]['url'] = url($child['data']['url']);
                                    }
                                    else 
                                    {
                                        $menus_data[$i]['url'] = $child['data']['url'];
                                    }
                                }
                            }
                            $i++;
                        }
                    }
                    $menus[$k]['data'] = $menus_data;
                }
            }
            config(['sys.setting.menus' => $menus]);


            return $next($request);

        });

    }


}
