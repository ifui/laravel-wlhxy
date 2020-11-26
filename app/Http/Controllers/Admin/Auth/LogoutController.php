<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * 退出登录
     *
     */
    public function logout()
    {
        $this->auth()->logout();

        return $this->success('退出登录成功');
    }
}
