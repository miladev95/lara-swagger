<?php

namespace Miladev\LaravelSwagger;

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
        
    }
}
