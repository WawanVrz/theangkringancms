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
use App\SysContent;
use App\Product;

use App\Traits\ContentData;


class MenuController extends BackendController
{

    use ContentData;


    function __construct(Request $request, Route $route)
    {
        $this->load_content_setting();

        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'menu';
        $module['name'] = ucwords(trans('backend/core.menus'));
        $module['action'] = array(
            'index' => 'index',
            'indexlanguage' => 'indexlanguage',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'edit',
            'update' => 'edit',
            'delete' => 'delete',
            'get_content' => 'index',
        );

        parent::__construct($request, $route, $module);
    }


    public function index(Request $request)
    {
        $content_settings = $this->content_settings;

        // dd($content_settings);
        $listed_contents = ['page','product'];

        $menu = SysSetting::where('key','menu')->where('website_id',$request->get('website'))->first();
        $menus = ($menu) ? json_decode($menu->value,true) : [];

        // dd($menus);

        // $menus[3] = $menus[2];
        // $menus[3]['key'] = 'menu_4';
        // $menus[3]['name'] = 'Footer 3 Menu';
        // $menus[0]['name'] = 'Header Menu';

        // echo json_encode($menus); die;


        // var_dump($menus); die;

        $contents = SysContent::getType($listed_contents[0]);

        return view('backend.pages.menu', compact('menus','contents','content_settings','listed_contents'));
    }


    public function indexlanguage(Request $request)
    {
        $content_settings = $this->content_settings;
        $listed_contents = ['page','product'];

        $menu = SysSetting::where('key','menu')->where('website_id',$request->get('website'))->first();
        $menus = ($menu) ? json_decode($menu->value,true) : [];

        // dd($menus);

        // $menus[3] = $menus[2];
        // $menus[3]['key'] = 'menu_4';
        // $menus[3]['name'] = 'Footer 3 Menu';
        // $menus[0]['name'] = 'Header Menu';

        // echo json_encode($menus); die;


        // var_dump($menus); die;

        $contents = SysContent::getType($listed_contents[0]);

        return view('backend.pages.language', compact('menus','contents','content_settings','listed_contents'));
    }

    
    public function get_content($type = '')
    {
        if($type != 'product')
        {
            $contents = SysContent::getType($type);
            $response['code'] = '200';
            $response['type'] = $this->content_settings[$type]['module_name'];
            $response['content']['name'] = $this->content_settings[$type]['module_name'];
            $response['content']['count'] = count($contents);
            $response['data'] = $contents;
            $response['message'] = '';
            echo json_encode($response);
        }
        else
        {
            $contents = Product::getType($type);
            $response['code'] = '200';
            $response['type'] = $this->content_settings[$type]['module_name'];
            $response['content']['name'] = $this->content_settings[$type]['module_name'];
            $response['content']['count'] = count($contents);
            $response['data'] = $contents;
            $response['message'] = '';
            echo json_encode($response);
        }
    }
    
    
    public function update(Request $request)
    {
        $menu = SysSetting::where('key','menu')->where('website_id',$request->input('website'))->first();
        $menu_new = $request->input('menu');
        $menus = ($menu) ? json_decode($menu->value,true) : [];
        if(count($menus) > 0)
        {
            foreach($menus as $k => $m)
            {
                if($k == $menu_new['key'])
                {
                    $menus[$k]['name'] = $menu_new['name'];
                    $menus[$k]['title'] = $menu_new['title'];
                    $menus[$k]['tree'] = $menu_new['tree'];
                }
            }
            $menu->value = json_encode($menus);
            $menu->save();
        }

        $response['code'] = '200';
        $response['message'] = ucfirst(trans('backend/core.data_saved'));
        echo json_encode($response);
    }
    

}