<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Spatie\Permission\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    use Filterable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'guard_name', 'comment'];
}
