<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Spatie\Permission\Models\Role as RoleModel;

class Role extends RoleModel
{
    use Filterable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'guard_name', 'comment'];
}
