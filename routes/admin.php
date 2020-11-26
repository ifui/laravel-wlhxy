<?php

/*
|--------------------------------------------------------------------------
| Admin Api Routes
|--------------------------------------------------------------------------
|
| admin 路由表
|
 */

$api = app('Dingo\Api\Routing\Router');

$params_v1 = [
    'version' => 'v1',
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Admin',
];

$api->group($params_v1, function ($api) {
    $api->get('test', function () {
        return 'test ok';
    });

    // 用户认证与注册
    $api->group(['namespace' => 'Auth'], function ($api) {
        $api->post('login', 'LoginController@login')->name('login');
        $api->post('register', 'RegisterController@register')->name('register');
        // Auth:api
        $api->group(['middleware' => 'auth:admin'], function ($api) {
            // 退出登录
            $api->get('logout', 'LogoutController@logout')->name('logout');
            // 刷新令牌
            $api->get('refresh', 'RefreshController@refresh')->name('refresh');
            $api->resource('user', 'AdminUserController');

        });

    });
});
