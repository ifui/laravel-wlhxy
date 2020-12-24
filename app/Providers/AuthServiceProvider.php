<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Implicitly grant "Super Admin" role all permission checks using can()
        // 当角色ID为1或者为 Super-Admin 时，can() 方法返回 true
        Gate::before(function ($user, $ability) {
            dump('user id' . $user->id);
            if ($user->hasRole('Super-Admin')) {
                return true;
            }
            if ($user->id === 1) {
                return true;
            }
        });

    }
}
