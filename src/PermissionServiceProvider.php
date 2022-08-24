<?php

namespace DevSajid\Permission;

use DevSajid\Permission\Console\PermissionSeedCommand;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views','permission');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                PermissionSeedCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/permission'),
        ]);
    }



    public function register()
    {

    }
}
