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
            AdminUser::create([
                'username' => $request['username'],
                'password' => Hash::make($request['password']),
            ]);

            return $this->success('注册成功');
        } catch (Exception $e) {
            return $this->response->error('用户注册失败');
        }
    }
}