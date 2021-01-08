<?php

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| api 路由表
|
 */

$api = app('Dingo\Api\Routing\Router');

$params_v1 = [
    'version' => 'v1',
    'prefix' => 'course',
    'namespace' => 'Modules\Course\Http\Controllers\V1',
];

$api->group($params_v1, function ($api) {
    $api->get('test', function () {
        return true;
    });

});
