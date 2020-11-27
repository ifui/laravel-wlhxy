<?php

namespace App\Http\Controllers\Admin\Log;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Log\LogRequest;
use App\Models\Activity;

class LogController extends Controller
{
    /**
     * 返回日志消息
     *
     * @param LogRequest $request
     * @return Response
     */
    public function log(LogRequest $request)
    {
        $data = Activity::filter($request->all())->paginateFilter();

        return $data;
    }
}
