<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as RoleModel;

class Role extends RoleModel
{
    // Filterable eloquentfilter
    // Laravel-activitylog LogsActivity
    use Filterable, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'guard_name', 'comment'];

    /**
     * 日志字段
     *
     * true 表示所有字段的改变都写入日志
     *
     * @var array|boolean
     */
    protected $logAttributes = true;
}
