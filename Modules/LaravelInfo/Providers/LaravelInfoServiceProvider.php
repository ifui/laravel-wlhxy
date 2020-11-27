<?php

namespace Modules\LaravelInfo\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;

class LaravelInfoServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('LaravelInfo', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('LaravelInfo', 'Config/config.php') => config_path('laravelinfo.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('LaravelInfo', 'Config/config.php'), 'laravelinfo'
        );
        $this->mergeConfigFrom(
            module_path('LaravelInfo', 'Config/linfo.php'), 'laravelinfo.linfo'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/laravelinfo');

        $sourcePath = module_path('LaravelInfo', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath,
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/laravelinfo';
        }, \Config::get('view.paths')), [$sourcePath]), 'laravelinfo');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/laravelinfo');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'laravelinfo');
        } else {
            $this->loadTranslationsFrom(module_path('LaravelInfo', 'Resources/lang'), 'laravelinfo');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (!app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('LaravelInfo', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
