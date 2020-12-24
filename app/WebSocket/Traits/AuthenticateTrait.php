<?php

namespace App\WebSocket\Traits;

use App\WebSocket\Tables\UserTable;

trait AuthenticateTrait
{
    /**
     * 检查认证信息
     *
     * @return Boolean|\Illuminate\Contracts\Auth\StatefulGuard
     */
    public function checkAuth($request)
    {
        $guards = config('auth.guards');
        $auth = auth();

        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard => $value) {
            // 用户已登录
            if ($auth->guard($guard)->check()) {
                $auth->shouldUse($guard);
                // 写入数据，绑定用户信息
                UserTable::set($request->fd, [
                    'fd' => $request->fd,
                    'uuid' => $auth->user()->uuid,
                    'guard' => $guard,
                ]);
                return $auth;
            }
        }

        // 用户未登录
        UserTable::set($request->fd, [
            'fd' => $request->fd,
            'uuid' => '',
            'guard' => '',
        ]);

        return false;
    }
}
