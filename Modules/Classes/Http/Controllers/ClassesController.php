<?php

namespace Modules\Classes\Http\Controllers;

use Illuminate\Routing\Controller;

class ClassesController extends Controller
{
    /**
     * 返回成功信息
     *
     * @param string $message 提示信息
     * @param int $status 状态码
     * @return \Illuminate\Http\Response
     */
    public function success(string $message, int $status = 200)
    {
        return Response([
            'status' => true,
            'message' => $message,
        ], $status);
    }

    /**
     * 返回失败信息
     *
     * @param string $message 提示信息
     * @param int $status 状态码
     * @param string $errors 错误信息
     * @return \Illuminate\Http\Response
     */
    public function error(string $message, int $status = 400, string $errors = null)
    {
        return Response([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }

}
