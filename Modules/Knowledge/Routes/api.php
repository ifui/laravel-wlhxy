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
    'prefix' => 'knowledge',
    'namespace' => 'Modules\Knowledge\Http\Controllers\V1',
];

$api->group($params_v1, function ($api) {
    $api->get('test', function () {
        return true;
    });

});
