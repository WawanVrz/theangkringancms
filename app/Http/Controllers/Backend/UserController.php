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

class UserController extends BackendController
{
    
    
    function __construct(Request $request, Route $route)
    {
        // Module identifier must be lowercase and using '_' as a infix
        $module['id'] = 'user';
        $module['name'] = ucwords(trans('backend/core.user'));
        $module['action'] = array(
            'index' => 'index',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'edit',
            'update' => 'edit',
            'delete' => 'delete',
            'datatable_bulk' => 'index',
            'datatable_callback_get_data' => 'index',
            'datatable_get_data_student' => 'index',
        );

        parent::__construct($request, $route, $module);
    }

    public function index()
    {
        $object = DB::table('sys_users')
                    ->join('sys_user_roles','sys_user_roles.id','=','sys_users.role_id')
                    ->select('sys_users.*','sys_user_roles.role')
                    ->where('sys_users.id','!=',Auth::user()->id)
                    ->where('sys_users.deleted_at','=',Null)
                    ->get();
        return view('backend.pages.user-account',compact('object'));
    }

    public function create()
    {
        $roleData = SysUserRole::where('id','!=',0)->get();
        return view('backend.pages.user-account-create', compact('roleData'));
    }

    public function store(Request $request)
    {
        $Account_data = $request->except('_token');
        $name = $request->input('username');
        $fields = [
            'role_id' => 'required',
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'password_repeat' => 'required',
            'image' => 'required',
            'active' => 'required',
        ];
        $message = [];
        $validator = Validator::make($request->all(), $fields, $message);


        $redirect_failed = url(env('BACKEND_ROUTE').'/user/account/create');
        $redirect_success = url(env('BACKEND_ROUTE').'/user/account');

        if ($validator->fails()) return redirect($redirect_failed)->withErrors($validator)->withInput();

        $filename = (string)(time() . '_' . $name . '.jpg');
        
        if($request->hasFile('image')) 
        {
            $request->file('image')->move('public/media/upload/avatar/', $filename);    
            $Account_data['image'] = $filename;
            $Account_data['image'] = $Account_data['image'];

            DB::beginTransaction();
            try{
                SysUser::create([
                            'username' => $request->input('username'),
                            'firstname' => $request->input('first_name'),
                            'lastname' => $request->input('last_name'),
                            'email' => $request->input('email'),
                            'telphone' => $request->input('phone'),
                            'password' => bcrypt($request->input('password')),
                            'role_id' => $request->input('role_id'),
                            'avatar' => $Account_data['image'],
                            'status' => $request->input('active'),
                            'api_token' => '3K9GBE5ksU3K9GBE5ksU'
                        ]);
                DB::commit();

                //----- SAVE TO TBL LOG -------
                $links = URL::to('/');
                SysLogging::create([
                    'user_id' => Auth::user()->id,
                    'fullname' => Auth::user()->username,
                    'user_role' => Auth::user()->role_id,
                    'status' => 'Create',
                    'content_type' => 'Users',
                    'website_id' => 0,
                    'url' => $links,
                    'notes' => Auth::user()->username.' has created this user : '.$request->input('username'),
                    'ac' => 1
                ]);
                \DB::commit();


                Session::flash('flash_message_success', 'User Account Has Been Successfully Created');
            }catch (\Exception $e) {
                Session::flash('flash_message_danger', $e->getmessage());
            }
            return redirect($redirect_success);
        }
    }


    public function edit($id)
    {
        $roleData = SysUserRole::where('id','!=',0)->get();
        $object = SysUser::find($id);
        if($object) return view('backend.pages.user-account-edit',compact('object','roleData'));
        else
        {
            Session::flash('flash_message_warning', ucfirst(trans('backend/core.data_not_found')));
            return redirect(url(env('BACKEND_ROUTE').'/user/account'));
        }
    }


    public function update(Request $request, $id)
    {
        $Account_data = $request->except('_token');
        $Account = SysUser::find($id);
        DB::beginTransaction();
        try{
            $redirect_failed = url(env('BACKEND_ROUTE').'/user/account/edit/'.$id);
            $redirect_success = url(env('BACKEND_ROUTE').'/user/account');

            if($request->input('password') != "")
            {
                DB::table('sys_users')
                    ->where('id', $id)
                    ->update([
                            'role_id' => $request->input('role_id'),
                            'username' => $request->input('username'),
                            'firstname' => $request->input('firstname'),
                            'lastname' => $request->input('lastname'),
                            'email' => $request->input('email'),
                            'telphone' => $request->input('telphone'),
                            'password' => bcrypt($request->input('password')),
                            'status' => $request->input('status'),
                ]);
            }
            else
            {
                DB::table('sys_users')
                    ->where('id', $id)
                    ->update([
                            'role_id' => $request->input('role_id'),
                            'username' => $request->input('username'),
                            'firstname' => $request->input('firstname'),
                            'lastname' => $request->input('lastname'),
                            'email' => $request->input('email'),
                            'telphone' => $request->input('telphone'),
                            'status' => $request->input('status'),
                ]);
            }
           DB::commit();

           //----- SAVE TO TBL LOG -------
           $links = URL::to('/');
           SysLogging::create([
               'user_id' => Auth::user()->id,
               'fullname' => Auth::user()->username,
               'user_role' => Auth::user()->role_id,
               'status' => 'Update',
               'content_type' => 'Users',
               'website_id' => 0,
               'url' => $links,
               'notes' => Auth::user()->username.' has changed something on this users : '.$request->input('username'),
               'ac' => 1
           ]);
           \DB::commit();

           Session::flash('flash_message_success', 'Account Has Been Successfully Updated');
           return redirect($redirect_success);
        }catch(Exception $e){
            Session::flash('flash_message_danger', $e->getmessage());
            DB::rollback();
            throw $e;
        }
    }

    public function delete($id)
    {
        if($object = SysUser::find($id))
        {
            //----- SAVE TO TBL LOG -------
            $links = URL::to('/');
            SysLogging::create([
                'user_id' => Auth::user()->id,
                'fullname' => Auth::user()->username,
                'user_role' => Auth::user()->role_id,
                'status' => 'Delete',
                'content_type' => 'Users',
                'website_id' => 0,
                'url' => $links,
                'notes' => Auth::user()->username.' has deleted this users : '.$object->username,
                'ac' => 1
            ]);
            \DB::commit();

            $object->delete();    
        }
        
    	Session::flash('flash_message_success', ucfirst(trans('backend/core.account_deleted')));
        return redirect(url(env('BACKEND_ROUTE').'/user/account'));
    }




    // // DATATABLE FUNCTIONS

    // public function datatable_callback_get_data($id)
    // {
    //     if($this->request->ajax())
    //     {
    //         // Student
    //         if($id == 3){
    //             $dt = $this->datatable_get_data_student($this->request->datatable_params);
    //             return json_encode(array('datatable_params' => $dt->config, 'action_single' => $dt->action_single, 'data' => $dt->data['row']));
    //         } 
    //         else
    //         {
    //             $dt = new DataTable($this->datatable['student']['id'], $this->datatable['student']);
    //             return $dt->fetchAjax($this->request->datatable_params);
    //         }
    //     }
    // }


    // public function datatable_bulk($action = '')
    // {
    //     $datatable = $this->datatable_prepare_table_student();
    //     $dt = new DataTable($datatable['id'], $datatable);
    //     $dt->config = json_decode($this->request->datatable_bulk_data,true);
    //     $selected_items = $dt->getSelectedItems();

    //     $sys_user = new SysUser();
    //     if($action == 'enable') $sys_user->bulk_user($selected_items, 'enable');
    //     else if($action == 'disable') $sys_user->bulk_user($selected_items, 'disable');
    //     else if($action == 'delete') $sys_user->bulk_user($selected_items, 'delete');
    //     Session::flash('flash_message_success', ucfirst(trans('backend/core.account_updated')));
    //     return redirect(url(env('BACKEND_ROUTE').'/user/account'));
    // }


    // private function datatable_prepare_table_student()
    // {
    //     $sys_user = new SysUser;
    //     $table['id'] = 'table_student';
    //     $table['base_table'] = $sys_user->getTable();
    //     $table['base_model'] = $sys_user->datatable_model('3'); // Student = 3
    //     $table['callback'] =  url(env('BACKEND_ROUTE').'/user/account/get/3');
    //     $table['column'] = [
    //                             0 => [
    //                                     'name' => 'ID',
    //                                     'field' => 'id',
    //                                     'width' => '7%',
    //                                     'data_align' => 'center',
    //                                     'sorted' => 'asc',
    //                                     'filter' => 'number_range',
    //                                     'attr' => 'key',
    //                             ],
    //                             1 => [
    //                                     'name' => 'Username',
    //                                     'field' => 'username',
    //                                     'width' => '10%',
    //                                     'data_align' => 'left',
    //                                     'sorted' => 'none',
    //                                     'filter' => 'text',
    //                             ],
    //                             3 => [
    //                                     'name' => 'Name',
    //                                     'field' => 'name',
    //                                     'width' => '20%',
    //                                     'data_align' => 'left',
    //                                     'sorted' => 'none',
    //                                     'filter' => 'text',
    //                             ],
    //                             4 => [
    //                                     'name' => 'Email',
    //                                     'field' => 'email',
    //                                     'width' => '20%',
    //                                     'data_align' => 'left',
    //                                     'sorted' => 'none',
    //                                     'filter' => 'text',
    //                             ],
    //                             5 => [
    //                                     'name' => 'Registered from',
    //                                     'field' => 'created_at',
    //                                     'width' => '10%',
    //                                     'data_align' => 'left',
    //                                     'sorted' => 'none',
    //                                     'filter' => 'date_range',
    //                             ],
    //                             6 => [
    //                                     'name' => 'Status',
    //                                     'field' => 'status',
    //                                     'width' => '10%',
    //                                     'data_align' => 'left',
    //                                     'sorted' => 'none',
    //                                     'filter' => 'select',
    //                                     'filter_select' => ['1' => 'Active', '0' => 'Inactive'],
    //                             ],
    //                         ];
    //     $table['action_single'] = [
    //                                 0 => [
    //                                             'label' => 'Edit',
    //                                             'callback' => url(env('BACKEND_ROUTE').'/user/account/edit/'),
    //                                             'actionpage' => 'current',
    //                                             'icon' => 'icon-pencil',
    //                                             'spacer' => false,
    //                                             'alert' => false,
    //                                             'alert_message' => false,
    //                                 ],
    //                                 1 => [
    //                                             'label' => 'Active',
    //                                             'callback' => url(env('BACKEND_ROUTE').'/user/account/enable/'),
    //                                             'actionpage' => 'current',
    //                                             'icon' => '',
    //                                             'spacer' => false,
    //                                             'alert' => true,
    //                                             'alert_message' => 'Are you sure to proccess this action ?',
    //                                 ],
    //                                 2 => [
    //                                             'label' => 'Inactive',
    //                                             'callback' => url(env('BACKEND_ROUTE').'/user/account/disable/'),
    //                                             'actionpage' => 'current', // current or newpage
    //                                             'icon' => '',
    //                                             'spacer' => false,
    //                                             'alert' => true,
    //                                             'alert_message' => 'Are you sure to proccess this action ?',
    //                                 ],
    //                                 3 => [
    //                                             'label' => 'Delete',
    //                                             'callback' => url(env('BACKEND_ROUTE').'/user/account/delete/'),
    //                                             'actionpage' => 'current',
    //                                             'icon' => 'icon-trash-alt',
    //                                             'spacer' => true,
    //                                             'alert' => true,
    //                                             'alert_message' => 'This process can\'t undone. Are you sure to delete this data ?',
    //                                 ],
    //                             ];
    //     $table['action_bulk'] = [
    //                                 0 => [
    //                                             'label' => 'Active',
    //                                             'callback' => url(env('BACKEND_ROUTE').'/user/account/bulk/enable'),
    //                                             'actionpage' => 'current',
    //                                             'icon' => '',
    //                                             'spacer' => false,
    //                                             'alert' => true,
    //                                             'alert_message' => 'Are you sure to proccess this action ?',
    //                                 ],
    //                                 1 => [
    //                                             'label' => 'Inactive',
    //                                             'callback' => url(env('BACKEND_ROUTE').'/user/account/bulk/disable'),
    //                                             'actionpage' => 'current',
    //                                             'icon' => '',
    //                                             'spacer' => false,
    //                                             'alert' => true,
    //                                             'alert_message' => 'Are you sure to proccess this action ?',
    //                                 ],
    //                                 2 => [
    //                                             'label' => 'Delete',
    //                                             'callback' => url(env('BACKEND_ROUTE').'/user/account/bulk/delete'),
    //                                             'actionpage' => 'current', // current or newpage
    //                                             'icon' => 'icon-trash-alt',
    //                                             'spacer' => false,
    //                                             'alert' => true,
    //                                             'alert_message' => 'This process can\'t undone. Are you sure to delete this data ?',
    //                                 ],
    //                             ];
    //     return $table;
    // }


    // private function &datatable_get_data_student($datatable_params = '')
    // {
    //     $datatable = $this->datatable_prepare_table_student();
    //     $dt = new DataTable($datatable['id'], $datatable);
    //     if($datatable_params != '') $dt->callbackAjax($this->request->datatable_params);
    //     foreach($dt->getData() as $i=>$d)
    //     {
    //         foreach($dt->columns() as $column)
    //         {
    //             if($column['field'] == 'status') $dt->data['row'][$i][$column['field']] = ($d->{$column['field']} == '1') ? 'Active' : 'Incative';
    //             else if($column['field'] == 'created_at') $dt->data['row'][$i][$column['field']] = date("F j, Y",strtotime($d->{$column['field']}));
    //             else $dt->data['row'][$i][$column['field']] = $d->{$column['field']};
    //         }
    //     }

    //     return $dt;

    // }

    // END DATATABLE FUNCTIONS

}