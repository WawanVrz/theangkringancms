<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Component\Datatable\DataTable;
use Session;
use Route;
use Validator;
use Auth;
use DB;
use URL;
use App\SysLogging;
use App\SysUser;
use App\SysUserData;
use App\SysUserRole;
use App\Pages;
use App\PagesBox;
use App\PagesTemplate;

class UserRoleController extends BackendController
{
    function __construct(Request $request, Route $route) 
    {
        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'role';
        $module['name'] = 'role';
        $module['action'] = array(
            'index' => 'index',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'edit',
            'update' => 'edit',
            'delete' => 'delete',
        );

        parent::__construct($request, $route, $module);
    }

    public function index()
    {
        $object = DB::table('sys_user_roles')
                    ->select('sys_user_roles.*')
                    ->where('sys_user_roles.deleted_at','=',Null)
                    ->get();
        return view('backend.pages.user-account-role',compact('object'));
    }

    public function store(Request $request)
    {
        $fields = [
            'namerole' => 'required',
        ];
        $message = [];
        $validator = Validator::make($request->all(), $fields, $message);

        $list= SysUserRole::all();
        $redirect_failed = url(env('BACKEND_ROUTE').'/user/role');
        $redirect_success = url(env('BACKEND_ROUTE').'/user/role');

        if ($validator->fails()) return redirect($redirect_failed)->withErrors($validator)->withInput();

            DB::beginTransaction();
            try{
                SysUserRole::create([
                    'role' => $request->input('namerole'),
                ]);
                DB::commit();

                //----- SAVE TO TBL LOG -------
                $links = URL::to('/');
                SysLogging::create([
                    'user_id' => Auth::user()->id,
                    'fullname' => Auth::user()->username,
                    'user_role' => Auth::user()->role_id,
                    'status' => 'Create',
                    'content_type' => 'User Role',
                    'website_id' => 0,
                    'url' => $links,
                    'notes' => Auth::user()->username.' has created this role : '.$request->input('namerole'),
                    'ac' => 1
                ]);
                \DB::commit();

                Session::flash('flash_message_success', 'Data Has Been Successfully Created');
            }catch (\Exception $e) {
                Session::flash('flash_message_danger', $e->getmessage());
            }
            return redirect($redirect_success);
    }

    public function edit($id)
    {
        $object = SysUserRole::find($id);
        $objectlist = DB::table('sys_user_roles')
                ->select('sys_user_roles.*')
                ->where('sys_user_roles.deleted_at','=',Null)
                ->get();
        if($object) return view('backend.pages.user-account-role-edit',compact('object','objectlist'));
        else
        {
            Session::flash('flash_message_warning', ucfirst(trans('backend/core.data_not_found')));
            return redirect(url(env('BACKEND_ROUTE').'/user/role'));
        }
    }

    public function update(Request $request, $id)
    {
        $role_data = $request->except('_token');
        $rolelist = SysUserRole::find($id);
        DB::beginTransaction();
        try{
            $redirect_failed = url(env('BACKEND_ROUTE').'/user/role/edit/'.$id);
            $redirect_success = url(env('BACKEND_ROUTE').'/user/role');
    
            $rolelist->update($role_data);
            DB::commit();

             //----- SAVE TO TBL LOG -------
             $links = URL::to('/');
             SysLogging::create([
                 'user_id' => Auth::user()->id,
                 'fullname' => Auth::user()->username,
                 'user_role' => Auth::user()->role_id,
                 'status' => 'Update',
                 'content_type' => 'User Role',
                 'website_id' => 0,
                 'url' => $links,
                 'notes' => Auth::user()->username.' has changed something on this role : '.$request->input('role'),
                 'ac' => 1
             ]);
             \DB::commit();

            Session::flash('flash_message_success', 'Data Has Been Successfully Updated');
            return redirect($redirect_success);
        }catch(Exception $e){
            Session::flash('flash_message_danger', $e->getmessage());
            DB::rollback();
            throw $e;
        }
    }

    public function delete($id)
    {
        if($object = SysUserRole::find($id))
        {
            //----- SAVE TO TBL LOG -------
            $links = URL::to('/');
            SysLogging::create([
                'user_id' => Auth::user()->id,
                'fullname' => Auth::user()->username,
                'user_role' => Auth::user()->role_id,
                'status' => 'Delete',
                'content_type' => 'User Role',
                'website_id' => 0,
                'url' => $links,
                'notes' => Auth::user()->username.' has deleted this role : '.$object->role,
                'ac' => 1
            ]);
            \DB::commit();

            $object->delete();    
        }
        
    	Session::flash('flash_message_success', 'Data Has Been Successfully Deleted');
        return redirect(url(env('BACKEND_ROUTE').'/user/role'));
    }
}