<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// =================== ROUTE FRONTEND DESCOTIS  ==========================
Route::get('lang/{code}', 'LanguageController@swap')->name('swaplang');
Route::get('user/login', 'UserController@login');
Route::get('user/logout', 'UserController@logout');
Route::post('user/signin', 'UserController@signin');
Route::get('user/signup', 'UserController@signup');
Route::get('user/account', 'UserController@account');
Route::get('getstate/{code}', 'AjaxController@getState');
Route::get('', 'PageController@index')->name('homepage');
Route::get('/', 'PageController@index')->name('homepage');
// =================== END ROUTE FRONTEND DESCOTIS  ==========================


// ================== ROUTE BACKEND DESCOTIS =================================
Route::get('y', function () { return baseurl(); });
Route::get('backend', 'Backend\BackendController@index');
Route::get('xx', 'Backend\XXController@index');
Route::get('xx/create', 'Backend\XXController@create');
Route::post('xx/store', 'Backend\XXController@store');
Route::get('xx/edit', 'Backend\XXController@edit');
Route::post('xx/update', 'Backend\XXController@update');
Route::get('xx/delete', 'Backend\XXController@delete');
Route::get('xx/callback', 'Backend\TestController@callback');
Route::get('xx/ajax', function () {
    return '
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>
        $.ajax({
            url : "http://siam.dev/xx?api_token=asdasd",
            type : "GET",
            success : function(data) {
                //alert("Data: "+data);
                console.log(data);
            },
            error : function(request,error)
            {
                alert("Request: "+JSON.stringify(request));
            }
        });
        </script>
    ';
});
Route::get('password', function () {
    return bcrypt('123456');
});

Route::get('setting', 'Backend\TestController@setting');
Route::group(['prefix' => env('BACKEND_ROUTE','managepage')], function () {
    Route::get('zz', 'Backend\ZZController@index');
    Route::get('zz/create', 'Backend\ZZController@create');
    Route::post('zz/store', 'Backend\ZZController@store');

    Route::get('', 'Backend\AuthController@index');
    Route::get('/', 'Backend\AuthController@index');

    Route::post('auth/login', 'Backend\AuthController@login');
    Route::get('auth/logout', 'Backend\AuthController@logout');
    Route::get('dashboard', 'Backend\DashboardController@index');
    Route::get('media', 'Backend\DashboardController@media');

    // CONTENT
    Route::get('content/listing', 'Backend\ContentController@index');
    Route::get('content/create', 'Backend\ContentController@create');
    Route::post('content/store', 'Backend\ContentController@store');
    Route::get('content/edit', 'Backend\ContentController@edit');
    Route::post('content/update', 'Backend\ContentController@update');
    Route::get('content/delete/{id}', 'Backend\ContentController@delete');
    Route::get('content/setting', 'Backend\ContentController@setting');
    // END CONTENT
 
    // SOCIAL MEDIA
    Route::get('setting/social/media', 'Backend\SosmedController@index');
    Route::get('setting/social/media/create', 'Backend\SosmedController@create');
    Route::post('setting/social/media/store', 'Backend\SosmedController@store')->name('sosmed.store');
    Route::get('setting/social/media/edit/{id}', 'Backend\SosmedController@edit');
    Route::patch('setting/social/media/update/{id}', 'Backend\SosmedController@update')->name('sosmed.update');
    Route::get('setting/social/media/delete/{id}', 'Backend\SosmedController@delete');
    // END SOCIAL MEDIA

    // LANGUAGES
    Route::get('languages', 'Backend\LanguageTranslationController@index')->name('languages');
    Route::post('translations/update', 'Backend\LanguageTranslationController@transUpdate')->name('translation.update.json');
    Route::post('translations/updateKey', 'Backend\LanguageTranslationController@transUpdateKey')->name('translation.update.json.key');
    Route::delete('translations/destroy/{key}', 'Backend\LanguageTranslationController@delete')->name('translations.destroy');
    Route::post('translations/create', 'Backend\LanguageTranslationController@store')->name('translations.create');
    // END LANGUAGES

    //  OTHER SETTING
    Route::get('setting/other/{id}', 'Backend\OtherSettingController@index');
    Route::patch('setting/other/update/{id}', 'Backend\OtherSettingController@update')->name('other.update');
    // END  OTHER SETTING

    // PAGES
    Route::get('pages', 'Backend\PageController@index');
    Route::get('pages/create', 'Backend\ContentPageController@create');
    Route::get('pages/create/{page_type}', 'Backend\ContentPageController@create');
    Route::post('pages/store', 'Backend\ContentPageController@store');
    Route::get('pages/edit/{id}', 'Backend\ContentPageController@edit');
    Route::post('pages/update', 'Backend\PageController@update');
    Route::get('pages/delete/{id}', 'Backend\PageController@delete');
    // END PAGES

    // BLOGS
    Route::get('content/blog/listing', 'Backend\BlogController@index');
    Route::get('content/blog/create', 'Backend\BlogController@create');
    Route::post('content/blog/store', 'Backend\BlogController@store');
    Route::get('content/blog/edit', 'Backend\BlogController@edit');
    Route::post('content/blog/update', 'Backend\BlogController@update');
    Route::get('content/blog/delete/{id}', 'Backend\BlogController@delete');
   
    Route::get('content/blog/category/listing', 'Backend\BlogController@category_index');
    Route::get('content/blog/category/create', 'Backend\BlogController@category_create');
    Route::post('content/blog/category/store', 'Backend\BlogController@category_store');
    Route::get('content/blog/category/edit', 'Backend\BlogController@category_edit');
    Route::post('content/blog/category/update', 'Backend\BlogController@category_update');
    Route::get('content/blog/category/delete/{id}', 'Backend\BlogController@category_delete');
    // END BLOGS

    // SETTING
    Route::get('setting/scope/{id}', 'Backend\SettingController@scope');
    Route::get('setting/general', 'Backend\SettingGeneralController@index');
    Route::post('setting/general/store_general', 'Backend\SettingGeneralController@store_general');
    Route::post('setting/general/store_contact', 'Backend\SettingGeneralController@store_contact');
    Route::post('setting/general/store_seo_url', 'Backend\SettingGeneralController@store_seo_url');
    // END SETTING

    // WEBSITE
    Route::get('website', 'Backend\WebsiteController@index');
    Route::post('website/store', 'Backend\WebsiteController@store');
    Route::post('website/update', 'Backend\WebsiteController@update');
    Route::get('website/delete/{id}', 'Backend\WebsiteController@delete');
    // END WEBSITE

    // USER
    Route::get('user/account', 'Backend\UserController@index');
    Route::post('user/account/get/{id}', 'Backend\UserController@datatable_callback_get_data');
    Route::post('user/account/bulk/{action}', 'Backend\UserController@datatable_bulk');
    Route::get('user/account/create', 'Backend\UserController@create');
    Route::post('user/account/store', 'Backend\UserController@store')->name('Account.store');
    Route::get('user/account/edit/{id}', 'Backend\UserController@edit');
    Route::patch('user/account/update/{id}', 'Backend\UserController@update')->name('Account.update');
    Route::get('user/account/delete/{id}', 'Backend\UserController@delete');
    // END USER

    // USER ROLE
    Route::get('user/role', 'Backend\UserRoleController@index');
    Route::post('user/role/store', 'Backend\UserRoleController@store')->name('role.store');
    Route::get('user/role/edit/{id}', 'Backend\UserRoleController@edit');
    Route::patch('user/role/update/{id}', 'Backend\UserRoleController@update')->name('role.update');
    Route::get('user/role/delete/{id}', 'Backend\UserRoleController@delete');
    // END USER ROLE

    // LOG
    Route::get('log/listing', 'Backend\SysLogController@index');
    // END LOGG

    Route::get('menu', 'Backend\MenuController@index');
    Route::get('menu/get_content/{type}', 'Backend\MenuController@get_content');
    Route::post('menu/update', 'Backend\MenuController@update');
    Route::get('language', 'Backend\MenuController@indexlanguage');
    Route::post('language/update', 'Backend\MenuController@updatelanguage');
});

Route::get('website/switch', 'CustomPageController@website_switch');
Route::get('{slug1}/{slug2?}', 'DynamicProductController@index')->name('detail-category');
