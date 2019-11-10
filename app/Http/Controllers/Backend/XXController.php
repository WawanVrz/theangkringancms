<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Auth;
use Session;

use App\SysSetting;
use App\SysPrivilege;

class XXController extends Controller
{


    function __construct()
    {
        echo 'parent construct <br>';
    }


}