<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AdminUser extends Authenticatable implements JWTSubject
{
    // HasRoles laravel-permission
    // Filterable eloquentfilter
    // Laravel-activitylog LogsActivity
    use Notifiable, HasRoles, Filterable, LogsActivity;

    // 指定守卫,参考 config/auth/guards
    protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'truename', 'avatar', 'password',
    ];

    /**
     * 日志字段
     *
     * true 表示所有字段的改变都写入日志
     *
     * @var array|boolean
     */
    protected $logAttributes = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
