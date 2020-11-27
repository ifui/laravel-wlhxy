<?php

/*
|--------------------------------------------------------------------------
| Admin Api Routes
|--------------------------------------------------------------------------
|
| admin 路由表
|
 */
use Illuminate\Support\Facades\Route;
$api = app('Dingo\Api\Routing\Router');

$params_v1 = [
    'version' => 'v1',
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Admin',
];

$api->group($params_v1, function ($api) {
    $api->get('test', function () {
        return true;
    });

    // 用户认证与注册
    $api->group(['namespace' => 'Auth'], function ($api) {
        $api->post('login', 'LoginController@login')->name('login');
        $api->post('register', 'RegisterController@register')->name('register');
        // Auth:admin
        $api->group(['middleware' => 'auth:admin'], function ($api) {
            // 退出登录
            $api->get('logout', 'LogoutController@logout')->name('logout');
            // 刷新令牌
            $api->get('refresh', 'RefreshController@refresh')->name('refresh');
            $api->get('userinfo', 'AdminUserController@index')->name('userinfo');

        });
    });

    // 后台管理相关API
    $api->group(['middleware' => 'auth:admin'], function ($api) {

        // 权限管理相关路由    注: 此操作应该为最高管理员权限才能执行
        $api->group([
            'namespace' => 'Permission',
        ], function ($api) {
            Route::pattern('permission', '[0-9]+');
            $api->resource('permissions', 'PermissionController');
        });

        // 角色管理相关路由    注: 此操作应该为最高管理员权限才能执行
        $api->group([
            'namespace' => 'Role',
        ], function ($api) {
            Route::pattern('role', '[0-9]+');
            $api->resource('roles', 'RoleController');
        });

        // 日志管理相关路由
        $api->group([
            'namespace' => 'Log',
        ], function ($api) {
            $api->get('logs', 'LogController@log')->name('log');
        });
    });

});
