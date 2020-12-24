<?php

namespace App\WebSocket\Routes;

use App\WebSocket\Client;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Swoole\WebSocket\Frame;

class Route
{
    public static function run(Frame $frame)
    {
        $swoole = app('swoole');
        $fd = $frame->fd;

        try {
            $request = json_decode($frame->data, true);
            $action = $request['channel'];
        } catch (\Exception $e) {
            app('swoole')->push($frame->fd, Client::error('open', '请检查提交参数'));
            return;
        }

        // 执行方法
        switch ($action) {
            case 'open':
                $swoole->push($fd, Client::success('open', 'connect success'));
                break;
            case 'test':
                $swoole->push($fd, Client::success('test', 'test ok'));
                break;
            case 'ping': // 心跳检测
                $frame->opcode = WEBSOCKET_OPCODE_PONG;
                $swoole->push($fd, Client::success('ping', $frame));
                break;
            case 'systemInfo':
                Task::deliver(new \App\WebSocket\Task\SystemInfoTask($frame));
                break;
            default:
                $swoole->push($fd, Client::error('open', '无效的订阅方法'));
        }

    }
}
