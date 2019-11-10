<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;

use Session;
use App\Http\Controllers\Controller;

use App\SysSetting;


class TestController extends Controller
{
    
    
    public function index(Request $request)
    {
        session(['sys_setting_website' => '0']);
        // $request->session()->put('app_setting_scope', 'xxs');
        // echo "haha";
        // dd($this->$global_app_setting);
        // $request->session()->put(['APP_LOCALE' => 'en']);
        //Session::save();
        $data = $request->session()->all();
        $data['base_url'] = config('sys_data.setting.base_url');
        // $data = session('app_setting_scope');
        //var_dump($data);
        //echo config('app_data.setting.app_name');
        return json_encode($data);
    }


    public function admin()
    {
        session(['sys_setting_website' => '0']);
        // return 'admin page';
        return view('backend.pages.dashboard');
        // return view('backend.pages.dashboard-top');
        // return view('backend.main');
    }


    public function dashboard()
    {
        return 'dashboard page';
    }

    public function callback()
    {
        echo '<pre>'; print_r(Session::all()); echo '</pre>';
        echo config('sys.setting.base_url');
        // if (Session::has('sys_error')) return 'xxxxx';
        // else return 'yyy -- '.\Session::get('sys_error');
    }


    public function setting()
    {
        $setting = new SysSetting;
        $setting->website_id = 0;
        $setting->key = 'test';
        $setting->value = 'value test';
        $setting->active = '1';
        $setting->save();
    }


    public function content_test()
    {
        $content_settings = [
            'example' => [
                'module_id' => 'content_example',
                'module_name' => 'example',
                'module_action' => [
                    'index' => 'index',
                    'create' => 'create',
                    'store' => 'create',
                    'edit' => 'edit',
                    'update' => 'edit',
                    'delete' => 'delete',
                ],
                'template' => 'default',
                'instruction' => 'Creating an example takes quite a few steps. Fill out the content below to present users relevant information of our website.',
                'field_container' => [
                    0 => [
                        'type' => 'custom',
                        'label' => 'Data fields',
                        'default_display' => 'show',
                        'field' => [
                            0 => [
                                'type' => 'heading',
                                'label' => 'text type',
                            ],
                            1 => [
                                'type' => 'text',
                                'id' => 'text_1',
                                'name' => 'text_1',
                                'label' => 'text 1',
                                'placeholder' => 'Text required',
                                'message_error' => [
                                    'required' => 'Text 1 Required',
                                ],
                                'required' => 'yes',
                                'width' => '12',
                            ],
                            2 => [
                                'type' => 'text',
                                'id' => 'text_2',
                                'name' => 'text_2',
                                'label' => 'text 2',
                                'placeholder' => 'Text required & Min 5 chars',
                                'message_error' => [
                                    'required' => 'Text 2 Required',
                                    'minlength' => 'Min 5 characters',
                                ],
                                'required' => 'yes',
                                'minlength' => '5',
                                'width' => '12',
                            ],
                            3 => [
                                'type' => 'text',
                                'id' => 'text_3',
                                'name' => 'text_3',
                                'label' => 'text 3',
                                'placeholder' => 'Text required & Max 7 chars',
                                'message_error' => [
                                    'required' => 'Text 3 Required',
                                    'maxlength' => 'Max 7 characters',
                                ],
                                'required' => 'yes',
                                'maxlength' => '7',
                                'width' => '12',
                            ],
                            4 => [
                                'type' => 'text',
                                'id' => 'text_4',
                                'name' => 'text_4',
                                'label' => 'text 4',
                                'placeholder' => 'Min 5 characters & Max 7 chars',
                                'message_error' => [
                                    'minlength' => 'Min 5 characters',
                                    'maxlength' => 'Max 7 characters',
                                ],
                                'required' => 'no',
                                'minlength' => '5',
                                'maxlength' => '7',
                                'width' => '12',
                            ],
                            // 2 => [
                            //     'type' => 'textarea',
                            //     'id' => 'excerpt',
                            //     'name' => 'excerpt',
                            //     'label' => 'short description',
                            //     'placeholder' => 'content short description',
                            //     'message_error' => '',
                            //     'required' => 'no',
                            //     'width' => '12',
                            //     'row' => '2',
                            // ],
                            // 3 => [
                            //     'type' => 'editor',
                            //     'id' => 'content',
                            //     'name' => 'content',
                            //     'label' => 'content',
                            //     'placeholder' => '',
                            //     'message_error' => '',
                            //     'required' => 'no',
                            //     'width' => '12',
                            // ],
                            // 3 => [
                            //     'type' => 'text',
                            //     'id' => 'field1',
                            //     'name' => 'field1',
                            //     'label' => 'field 1',
                            //     'placeholder' => '',
                            //     'message_error' => '',
                            //     'required' => 'no',
                            //     'width' => '4',
                            // ],
                            // 4 => [
                            //     'type' => 'text',
                            //     'id' => 'field2',
                            //     'name' => 'field2',
                            //     'label' => 'field 2',
                            //     'placeholder' => '',
                            //     'message_error' => '',
                            //     'required' => 'no',
                            //     'width' => '4',
                            // ],
                            // 5 => [
                            //     'type' => 'text',
                            //     'id' => 'field3',
                            //     'name' => 'field3',
                            //     'label' => 'field 3',
                            //     'placeholder' => '',
                            //     'message_error' => '',
                            //     'required' => 'no',
                            //     'width' => '4',
                            // ],
                            
                        ],
                    ],
                    1 => [
                        'type' => 'custom',
                        'label' => 'additional data',
                        'default_display' => 'hide',
                        'field' => [
                            0 => [
                                'type' => 'group',
                                'id' => 'testimonial',
                                'label' => 'testimonials',
                                'repeatable' => 'yes',
                                'field' => [
                                    0 => [
                                        'type' => 'text',
                                        'id' => 'name',
                                        'name' => 'name',
                                        'label' => 'name',
                                        'placeholder' => 'Enter customer name',
                                        'message_error' => '',
                                        'required' => 'no',
                                        'width' => '6',
                                    ],
                                    1 => [
                                        'type' => 'text',
                                        'id' => 'city',
                                        'name' => 'city',
                                        'label' => 'city',
                                        'placeholder' => 'Enter customer city',
                                        'message_error' => '',
                                        'required' => 'no',
                                        'width' => '6',
                                    ],
                                    2 => [
                                        'type' => 'textarea',
                                        'id' => 'testimonial',
                                        'name' => 'testimonial',
                                        'label' => 'testimonial',
                                        'placeholder' => 'customer testimonial',
                                        'message_error' => '',
                                        'required' => 'no',
                                        'width' => '12',
                                    ],
                                    3 => [
                                        'type' => 'avatar',
                                        'id' => 'picture',
                                        'name' => 'picture',
                                        'label' => 'picture',
                                        'placeholder' => '',
                                        'message_error' => '',
                                        'required' => 'no',
                                        'width' => '12',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    2 => [
                        'type' => 'media',
                        'label' => 'media',
                        'default_display' => 'show',
                        'feature' => ['image','gallery','video'],
                    ],
                    3 => [
                        'type' => 'seo',
                        'label' => 'search engine optimization',
                        'default_display' => 'hide',
                        'feature' => ['keywords','advanced'],
                    ],
                ],
            ],
            'page' => [
                'module_id' => 'content_page',
                'module_name' => 'page',
                'module_action' => [
                    'index' => 'index',
                    'create' => 'create',
                    'store' => 'create',
                    'edit' => 'edit',
                    'update' => 'edit',
                    'delete' => 'delete',
                ],
                'template' => 'default',
                'instruction' => 'Creating a page takes quite a few steps. Fill out the page\'s content below to present users relevant information of our website.',
                'field_container' => [
                    0 => [
                        'type' => 'custom',
                        'label' => 'general',
                        'default_display' => 'show',
                        'field' => [
                            0 => [
                                'type' => 'text',
                                'id' => 'title',
                                'name' => 'title',
                                'label' => 'page title',
                                'placeholder' => 'Enter page title here',
                                'message_error' => 'page title required',
                                'required' => 'yes',
                                'width' => '12',
                            ],
                            1 => [
                                'type' => 'textarea',
                                'id' => 'excerpt',
                                'name' => 'excerpt',
                                'label' => 'short description',
                                'placeholder' => 'content short description',
                                'message_error' => '',
                                'required' => 'no',
                                'width' => '12',
                                'row' => '2',
                            ],
                            2 => [
                                'type' => 'editor',
                                'id' => 'content',
                                'name' => 'content',
                                'label' => 'content',
                                'placeholder' => '',
                                'message_error' => '',
                                'required' => 'no',
                                'width' => '12',
                            ],
                            3 => [
                                'type' => 'text',
                                'id' => 'field1',
                                'name' => 'field1',
                                'label' => 'field 1',
                                'placeholder' => '',
                                'message_error' => '',
                                'required' => 'no',
                                'width' => '4',
                            ],
                            4 => [
                                'type' => 'text',
                                'id' => 'field2',
                                'name' => 'field2',
                                'label' => 'field 2',
                                'placeholder' => '',
                                'message_error' => '',
                                'required' => 'no',
                                'width' => '4',
                            ],
                            5 => [
                                'type' => 'text',
                                'id' => 'field3',
                                'name' => 'field3',
                                'label' => 'field 3',
                                'placeholder' => '',
                                'message_error' => '',
                                'required' => 'no',
                                'width' => '4',
                            ],
                            
                        ],
                    ],
                    1 => [
                        'type' => 'media',
                        'label' => 'media',
                        'default_display' => 'show',
                        'feature' => ['image','gallery','video'],
                    ],
                    2 => [
                        'type' => 'seo',
                        'label' => 'search engine optimization',
                        'default_display' => 'hide',
                        'feature' => ['keywords','advanced'],
                    ],
                    3 => [
                        'type' => 'custom',
                        'label' => 'additional data',
                        'default_display' => 'hide',
                        'field' => [
                            0 => [
                                'type' => 'group',
                                'id' => 'testimonial',
                                'label' => 'testimonials',
                                'repeatable' => 'yes',
                                'field' => [
                                    0 => [
                                        'type' => 'text',
                                        'id' => 'name',
                                        'name' => 'name',
                                        'label' => 'name',
                                        'placeholder' => 'Enter customer name',
                                        'message_error' => '',
                                        'required' => 'no',
                                        'width' => '6',
                                    ],
                                    1 => [
                                        'type' => 'text',
                                        'id' => 'city',
                                        'name' => 'city',
                                        'label' => 'city',
                                        'placeholder' => 'Enter customer city',
                                        'message_error' => '',
                                        'required' => 'no',
                                        'width' => '6',
                                    ],
                                    2 => [
                                        'type' => 'textarea',
                                        'id' => 'testimonial',
                                        'name' => 'testimonial',
                                        'label' => 'testimonial',
                                        'placeholder' => 'customer testimonial',
                                        'message_error' => '',
                                        'required' => 'no',
                                        'width' => '12',
                                    ],
                                    3 => [
                                        'type' => 'avatar',
                                        'id' => 'picture',
                                        'name' => 'picture',
                                        'label' => 'picture',
                                        'placeholder' => '',
                                        'message_error' => '',
                                        'required' => 'no',
                                        'width' => '12',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'post' => [
                'module_id' => 'content_post',
                'module_name' => [
                    'en' => 'post',
                    'fr' => 'post',
                ],
                'module_action' => [
                    'index' => 'index',
                    'create' => 'create',
                    'store' => 'create',
                    'edit' => 'edit',
                    'update' => 'edit',
                    'delete' => 'delete',
                ],
            ],
        ];

        echo json_encode($content_settings);
    }


}