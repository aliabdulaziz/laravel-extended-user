<?php

namespace Aliabdulaziz\LaravelExtendedUser;

use Illuminate\Support\ServiceProvider;

class LaravelExtendedUserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Load Migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations', 'laravelextendeduser');

        // Load Routes
        $this->loadRoutesFrom(__DIR__.'/routes/web.php', 'laravelextendeduser');

        // Load Views
        $this->loadViewsFrom(__DIR__.'/views', 'laravelextendeduser');

        // Publish Views
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/laravelextendeduser'),
        ], 'views');

        // Publish Assets
        $this->publishes([
            __DIR__.'/assets/dist' => public_path('vendor/laravelextendeduser'),
        ], 'assets');
        
        $this->publishes([
            __DIR__.'/assets/src' => resource_path('assets/vendor/laravelextendeduser'),
        ], 'src');

        // Publish Config File
        $this->publishes([
            __DIR__.'/config/laravelextendeduser.php' => config_path('laravelextendeduser.php'),
        ], 'config');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /*$this->app->bind('extended-user', function ($app) {
            return new LaravelExtendedUser;
        });*/
    }
}
