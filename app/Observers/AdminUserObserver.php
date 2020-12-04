<?php

namespace App\Observers;

use App\Models\AdminUser;
use Ramsey\Uuid\Uuid;

class AdminUserObserver
{
    /**
     * 监听数据即将创建的事件
     *
     * @param  User $user
     * @return void
     */
    public function creating(AdminUser $model)
    {
        // 自动生成唯一 uuid 值
        $model->uuid = Uuid::uuid4()->toString();
    }
}
