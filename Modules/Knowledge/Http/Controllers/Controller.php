<?php

namespace Modules\Knowledge\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
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
        return Response(['message' => $message], $status);
    }

    /**
     * 返回错误信息
     *
     * @param string $message 提示信息
     * @param integer $status 状态码
     * @param string $errors 详细错误信息
     * @return void
     */
    public function error(string $message, int $status = 400, $errors = '')
    {
        return Response([
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }

}
