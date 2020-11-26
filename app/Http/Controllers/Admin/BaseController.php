<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    /**
     * 返回认证守卫
     *
     * @return @var \Illuminate\Support\Facades\Auth $auth
     */
    public function auth()
    {
        return Auth::guard('admin');
    }

}
