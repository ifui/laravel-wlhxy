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
    'prefix' => 'admin/course',
    'namespace' => 'Modules\Course\Http\Controllers\Admin',
    'middleware' => 'auth:admin',
];

$api->group($params_v1, function ($api) {
    $api->get('test', function () {
        return true;
    });

    // 分类列表
    // $api->resource('categories', 'CategoryController');

});
