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
    'prefix' => 'laravel-info',
    'namespace' => 'Modules\LaravelInfo\Http\Controllers',
];

$api->group($params_v1, function ($api) {
    $api->group(['middleware' => 'auth:admin'], function ($api) {
        $api->get('/', 'LaravelInfoController@index');
    });
});
