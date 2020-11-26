<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\V1\BaseController as Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * 注册后台用户
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = new User();

            $user->username = $request['username'];
            $user->password = Hash::make($request['password']);

            // 自动生成用户头像
            $user->avatar = $this->create_avatar($user->username);

            $user->save();

            return $this->success('注册成功', 201);
        } catch (Exception $e) {
            return $this->response->error('用户注册失败', 401);
        }
    }
}
