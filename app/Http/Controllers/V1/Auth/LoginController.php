<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\V1\BaseController as Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $username = $request->username;
        $password = $request->password;

        if (!$token = $this->auth()->attempt([
            'username' => $username,
            'password' => $password,
        ])) {
            return $this->response->error('登录失败', 401);
        }

        return $this->respondWithToken($token);
    }
}
