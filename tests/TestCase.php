<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Miladev\LaravelSwagger\LaravelSwaggerServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelSwaggerServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        // Use in-memory sqlite just to satisfy Laravel's DB requirements
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
