<?php

namespace App\Providers;

use App\Models\AdminUser;
use App\Models\User;
use App\Observers\AdminUserObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Implicitly grant "Super Admin" role all permission checks using can()
        // 当角色ID为1或者为 Super-Admin 时，can() 方法返回 true
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('Super-Admin')) {
                return true;
            }
            if ($user->id === 1) {
                return true;
            }
        });

        // 为 User|AdminUser 模型注册观察者
        User::observe(UserObserver::class);
        AdminUser::observe(AdminUserObserver::class);
    }
}
