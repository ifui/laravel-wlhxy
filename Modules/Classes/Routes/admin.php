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
    'prefix' => 'admin/classes',
    'namespace' => 'Modules\Classes\Http\Controllers\Admin',
    'middleware' => 'auth:admin',
];

$api->group($params_v1, function ($api) {
    $api->get('test', function () {
        return '11';
    });

    // 课程
    $api->resource('courses', 'CourseController');

    // 章节
    $api->resource('chapters', 'ChapterController');

    // 年级
    $api->resource('grades', 'GradeController');

    // 推荐
    $api->resource('positions', 'PositionController');

});
