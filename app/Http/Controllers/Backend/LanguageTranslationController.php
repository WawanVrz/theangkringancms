<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\Schema\Blueprint;
use App\Http\Controllers\Controller;
use App\Traits\ContentData;
use Validator;
use Session;
use Schema;
use Config;
use Route;
use Auth;
use File;
use Lang;
use DB;

class LanguageTranslationController extends BackendController
{
    function __construct(Request $request, Route $route)
    {
        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'language';
        $module['name'] = 'language';
        $module['action'] = array(
            'index' => 'index',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'edit',
            'update' => 'edit',
            'delete' => 'delete',
            'openJSONFile' => 'open',
            'saveJSONFile' => 'save',
            'transUpdate' => 'edit',
            'transUpdateKey' => 'edit'
        );
        parent::__construct($request, $route, $module);
    }

    public function index()
    {
        $languages = DB::table('languages')->get();

        $columns = [];
        $columnsCount = $languages->count();

        if($languages->count() > 0){
            foreach ($languages as $key => $language){
                if ($key == 0) {
                    $columns[$key] = $this->openJSONFile($language->code);
                }
                $columns[++$key] = ['data'=>$this->openJSONFile($language->code), 'lang'=>$language->code];
            }
        }

        return view('backend.pages.content-listing-lang', compact('languages','columns','columnsCount'));
    }

    public function store(Request $request)
    {

		$data = $this->openJSONFile('fr');
        $data[$request->key] = $request->value;

        $this->saveJSONFile('fr', $data);

        return redirect()->route('languages');
    }

    public function delete($key)
    {
        $languages = DB::table('languages')->get();

        if($languages->count() > 0){
            foreach ($languages as $language){
                $data = $this->openJSONFile($language->code);
                unset($data[$key]);
                $this->saveJSONFile($language->code, $data);
            }
        }
        return response()->json(['success' => $key]);
    }

    private function openJSONFile($code)
    {
        $jsonString = [];
        if(File::exists(base_path('resources/lang/'.$code.'.json'))){
            $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
            $jsonString = json_decode($jsonString, true);
        }
        return $jsonString;
    }

    private function saveJSONFile($code, $data)
    {
        ksort($data);
        $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        file_put_contents(base_path('resources/lang/'.$code.'.json'), stripslashes($jsonData));
    }

    public function transUpdate(Request $request)
    {
        $data = $this->openJSONFile($request->code);
        $data[$request->pk] = $request->value;

        $this->saveJSONFile($request->code, $data);
        return response()->json(['success'=>'Done!']);
    }

    public function transUpdateKey(Request $request)
    {
        $languages = DB::table('languages')->get();

        if($languages->count() > 0){
            foreach ($languages as $language){
                $data = $this->openJSONFile($language->code);
                if (isset($data[$request->pk])){
                    $data[$request->value] = $data[$request->pk];
                    unset($data[$request->pk]);
                    $this->saveJSONFile($language->code, $data);
                }
            }
        }

        return response()->json(['success'=>'Done!']);
    }
}
