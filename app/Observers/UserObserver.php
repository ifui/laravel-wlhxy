<?php

namespace App\Observers;

use App\Models\User;
use Ramsey\Uuid\Uuid;

class UserObserver
{
    /**
     * 监听数据即将创建的事件
     *
     * @param  User $user
     * @return void
     */
    public function creating(User $model)
    {
        // 自动生成唯一 uuid 值
        $model->uuid = Uuid::uuid4()->toString();
    }
}
