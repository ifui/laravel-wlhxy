<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 返回认证守卫
     *
     * @return @var \Illuminate\Support\Facades\Auth $auth
     */
    public function auth()
    {
        return Auth::guard('admin');
    }

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
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->auth()->factory()->getTTL() * 60,
        ]);
    }
}
