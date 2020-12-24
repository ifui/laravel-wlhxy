<?php

namespace App\WebSocket;

class Client
{
    /**
     * 返回成功消息
     *
     * @param Data $message
     * @return JSON
     */
    public static function success($channel, $data, $code = 200)
    {
        return collect([
            'status' => 'success',
            'channel' => $channel,
            'code' => $code,
            'data' => $data,
        ])->toJson();
    }

    /**
     * 返回失败消息
     *
     * @param Data $message
     * @return JSON
     */
    public static function error($channel, $message, $code = 500, $errors = '')
    {
        return collect([
            'status' => 'error',
            'channel' => $channel,
            'code' => $code,
            'message' => $message,
            'errors' => $errors,
        ])->toJson();
    }
}
