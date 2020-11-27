<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * 返回后台登录用户信息
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = AdminUser::with('roles', 'permissions')->find($user_id);
        return $user;
    }
}
