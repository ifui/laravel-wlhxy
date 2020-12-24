<?php

namespace App\WebSocket\Tables;

class TimerTable
{
    // 客户端
    protected $fd;
    // 启动状态值
    protected $START = 1;
    // 停止状态值
    protected $STOP = 0;
    // 指定列名
    protected $column;

    public function __construct(int $fd, String $column)
    {
        $this->fd = $fd;
        $this->column = $column;
    }

    /**
     * 获取指定列
     *
     * @param String $column
     * @return void
     */
    public function get(String $column = '')
    {
        if ($column === '') {
            $column = $this->column;
        }
        return app('swoole')->TimerTable->get($this->fd, $this->column);
    }

    /**
     * 设置指定列
     *
     * @param String $column
     * @param String $value
     * @return void
     */
    public function set(String $column, String $value)
    {
        return app('swoole')->TimerTable->set($this->fd, [
            $column => $value,
        ]);
    }

    /**
     * 设置指定列为停止状态
     *
     * @return void
     */
    public function setStop()
    {
        return app('swoole')->TimerTable->set($this->fd, [
            $this->column => $this->STOP,
        ]);
    }

    /**
     * 设置指定列为启动状态
     *
     * @return void
     */
    public function setStart()
    {
        return app('swoole')->TimerTable->set($this->fd, [
            $this->column => $this->START,
        ]);
    }
}
