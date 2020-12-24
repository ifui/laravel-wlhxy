<?php

namespace App\WebSocket\Services;

use App\WebSocket\Routes\Route;
use App\WebSocket\Tables\UserTable;
use App\WebSocket\Traits\AuthenticateTrait;
use Hhxsv5\LaravelS\Swoole\WebSocketHandlerInterface;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

/**
 * @see https://wiki.swoole.com/#/start/start_ws_server
 */
class WebSocketService implements WebSocketHandlerInterface
{
    use AuthenticateTrait;

    // 声明没有参数的构造函数
    public function __construct()
    {

    }

    public function onOpen(Server $server, Request $request)
    {

        $fd = $request->fd;
        // 鉴权，未登录用户直接断开连接
        if (!$this->checkAuth($request)) {
            $server->disconnect($fd);
            return;
        }

        echo date('Y-m-d H:i:s') . "客户端 ${fd} 打开了 WebSocket 连接\n";
    }

    public function onMessage(Server $server, Frame $frame)
    {
        // 执行路由方法
        Route::run($frame);

        echo "Received message\n";
    }

    public function onClose(Server $server, $fd, $reactorId)
    {
        // 删除记录
        UserTable::del($fd);
        echo date('Y-m-d H:i:s') . "客户端 ${fd} 关闭了 WebSocket 连接\n";
    }

}
