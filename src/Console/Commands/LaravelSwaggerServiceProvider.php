<?php

namespace Miladev\LaravelSwagger;;

use Illuminate\Support\ServiceProvider;

class LaravelSwaggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\CreateSwaggerCommand::class,
            ]);
        }
    }

    public function register()
    {
        // Register any bindings or services here if needed.
    }
}
