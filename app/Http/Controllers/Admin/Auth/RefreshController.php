<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

class RefreshController extends Controller
{
    /**
     * 刷新令牌
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        $token = $this->auth()->refresh();

        return $this->respondWithToken($token);
    }
}
