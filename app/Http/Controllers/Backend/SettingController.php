<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Session;
use Route;

use App\SysWebsite;


class SettingController extends BackendController
{

    function __construct(Request $request, Route $route)
    {
        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'setting';
        $module['name'] = ucwords(trans('backend/core.setting'));
        $module['action'] = array(
            'scope' => 'scope',
        );

        parent::__construct($request, $route, $module);
    }


    public function scope($id)
    {        
        $sys_website = SysWebsite::find($id);
        if($sys_website) $scope = $id;
        else $scope = 0;
        Session::put('sys_website_scope', $scope);
    }


}