<?php

namespace App\Providers;

use App\Models\AdminUser;
use App\Models\User;
use App\Observers\AdminUserObserver;
use App\Observers\UserObserver;
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
        // 为 User|AdminUser 模型注册观察者
        User::observe(UserObserver::class);
        AdminUser::observe(AdminUserObserver::class);
    }
}
