<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facade as Avatar;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Helpers;

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

    /**
     * 生成头像
     *
     * @param string $username 用户名
     * @param integer $id ID
     * @return void
     */
    protected function create_avatar(string $username)
    {
        // 头像保存路径
        $avatar_path = 'images/avatars/' . md5(time()) . '.png';
        // 头像保存完整路径
        $avatar_save_path = storage_path('app/public/') . $avatar_path;
        Avatar::create($username)->save($avatar_save_path);
        // 返回头像 URL
        return Storage::url($avatar_path);
    }
}
