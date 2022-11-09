<?php

namespace Suainul\Rabbitmq\Providers;

use Illuminate\Support\ServiceProvider;
use Suainul\Rabbitmq\Rabbitmq;

class RabbitmqProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/rabbitmq.php', 'rabbitmq');

        // Register the service the package provides.
        $this->app->singleton(Rabbitmq::class, function ($app) {
            return new Rabbitmq;
        });
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../../config/rabbitmq.php' => config_path('rabbitmq.php'),
        ], 'rabbitmq.config');
    }
}