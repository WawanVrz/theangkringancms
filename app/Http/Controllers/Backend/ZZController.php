<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;
// use App\Traits\BackendModule;

use Session;


class ZZController extends Controller
{

    // use BackendModule;


    function __construct(Request $request)
    {
        // Module identifier must be lowercase and using '_' as a infix
        $this->module['id'] = 'zz';
        $this->module['name'] = 'ZZ module';
        $this->module['label'] = 'zz_module';
        $this->module['baseurl'] = 'zz';

        $this->request = $request;
    }


    public function index()
    {
        $this->init_method('index');

        echo '<pre>'; print_r(Session::all()); echo '</pre>';
        echo 'masuk index with data : '.config('sys.setting.base_url');
    }


    private function view()
    {
        return 'masuk view';
    }

 
    private function listing()
    {
        return 'masuk listing';
    }


    public function create()
    {
        // $this->init_method('create');

        return view('backend.pages.zz-create',compact('this'));
    }


    public function store(Request $request)
    {
        $this->init_method('create');
        echo 'Data Store:<br>';
        echo '<pre>';
        
        // Date picker handle
        echo $request->input('date_single'); echo ' -> '; echo date('Y-m-d H:i:s', strtotime($request->input('date_single')));

        dd($request->input());
        echo '</pre>';
        return 'masuk store';
    }


    public function edit()
    {
        return 'masuk edit';
    }


    public function update(Request $request)
    {
        return 'masuk update';
    }


    public function delete(Request $request)
    {
        return 'masuk delete';
    }


}