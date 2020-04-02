<?php

namespace CreatvStudio\Itexmo;

use CreatvStudio\Itexmo\Itexmo;
use Illuminate\Support\ServiceProvider;

class ItexmoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../../config/itexmo.php', 'services.itexmo');

        // Register the main class to use with the facade
        $this->app->singleton('itexmo', function () {
            $config = config('services.itexmo');
            return (new Itexmo($config['code'], $config['password']))->sender($config['sender_id']);
        });
    }
}
