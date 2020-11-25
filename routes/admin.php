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
        // Auth:api
        $api->group(['middleware' => 'auth:api'], function ($api) {
            $api->get('auth', function () {
                return 'auth ok';
            });
        });

    });
});
