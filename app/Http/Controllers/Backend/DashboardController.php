<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use DB;
use Session;
use Route;

class DashboardController extends BackendController
{

    function __construct(Request $request, Route $route)
    {
        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'dashboard';
        $module['name'] = ucwords(trans('backend/core.dashboard'));
        $module['action'] = array(
            'index' => 'index',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'edit',
            'update' => 'edit',
            'delete' => 'delete',
            'media' => 'media',
        );

        parent::__construct($request, $route, $module);
    }


    public function index()
    {
        return view('backend.pages.dashboard');
    }

    public function media()
    {
        return view('backend.pages.content-listing-media');
    }
}