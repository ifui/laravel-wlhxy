<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Http\Requests\Auth\AdminRegisterRequest;
use App\Models\AdminUser;
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
    public function register(AdminRegisterRequest $request)
    {
        try {
            $user = new AdminUser();

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
