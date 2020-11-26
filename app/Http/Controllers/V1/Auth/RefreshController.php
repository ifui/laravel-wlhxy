<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\V1\BaseController as Controller;

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
