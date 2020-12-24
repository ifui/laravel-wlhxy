<?php

namespace App\WebSocket\Task;

use App\WebSocket\Client;
use App\WebSocket\Tables\TimerTable;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Linfo\Linfo;
use Swoole\Timer;

class SystemInfoTask extends Task
{
    private $frame;
    // 循环时间
    protected $ms = 1000;
    // 定时器数据表对象
    private $timerTable;

    protected $timerTableColumn = 'systemInfo';

    public function __construct($frame)
    {
        $this->frame = $frame;
        $this->timerTable = new TimerTable($frame->fd, 'systemInfo');
    }

    public function handle()
    {
        $data = json_decode($this->frame->data);

        // 执行类型判断
        if ($data->data && $data->data === 'start') {
            // 没有在运行则启动定时器
            if (!$this->timerTable->get()) {
                // 设置触发信号为 1
                $this->timerTable->setStart();
                $this->runTimer();
            }
        }

        if ($data->data && $data->data === 'stop') {
            // 设置触发信号为 0
            $this->timerTable->setStop();
        }

        return 'Finished';
    }

    public function runTimer()
    {
        Timer::tick($this->ms, function ($tiemrId) {

            // 判断是否触发停止信号
            if ($this->timerTable->get() === 0) {
                Timer::clear($tiemrId);
            }

            $this->getInfo();
        });
    }

    public function getInfo()
    {
        $linfo = new Linfo(config('linfo'));
        $linfo->scan();
        $ram = $linfo->getRAM();
        $ramUsage = ($ram['total'] - $ram['free']) / $ram['total'];
        $ramUsage = round($ramUsage, 4);
        $cpuUsage = round($linfo->getCpuUsage() / 100, 4);
        $mountUsage = $linfo->getMounts()[0]['used_percent'] / 100;

        $data = [
            'CPU' => $cpuUsage,
            'RAM' => $ramUsage,
            'Mounts' => $mountUsage,
        ];

        app('swoole')->push($this->frame->fd, Client::success('systemInfo', $data));
    }
}
