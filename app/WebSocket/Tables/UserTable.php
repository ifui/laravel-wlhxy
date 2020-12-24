<?php

namespace App\WebSocket\Tables;

class UserTable
{
    /**
     * 获取
     *
     * @param String $fd
     * @param String $field
     * @return void
     */
    public static function get(String $fd, String $field = null)
    {
        return app('swoole')->UserTable->get($fd, $field);
    }

    /**
     * 设置
     *
     * @param String $fd
     * @param array $value
     * @return void
     */
    public static function set(String $fd, array $value)
    {
        return app('swoole')->UserTable->set($fd, $value);
    }

    /**
     * 删除
     *
     * @param String $fd
     * @param array $value
     * @return void
     */
    public static function del(String $fd)
    {
        return app('swoole')->UserTable->del($fd);
    }
}
