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
use App\Traits\ContentData;

class SysLogController extends BackendController
{
    function __construct(Request $request, Route $route)
    {
        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'syslog';
        $module['name'] = 'syslog';
        $module['action'] = array(
            'index' => 'index',
        );
        
        parent::__construct($request, $route, $module);
    }

    public function index()
    {
        $list = DB::table('sys_logging')
                ->join('sys_websites','sys_websites.id','=','sys_logging.website_id')
                ->select('sys_logging.*','sys_websites.name','sys_websites.locale')
                ->orderby('sys_logging.created_at', 'desc')
                ->get();

        return view('backend.pages.content-listing-log',compact('list'));
    }
}
