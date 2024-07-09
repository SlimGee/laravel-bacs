<?php

namespace LaravelBacs\LaravelBacs\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelBacs\LaravelBacs\LaravelBacsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'LaravelBacs\\LaravelBacs\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelBacsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-bacs_table.php.stub';
        $migration->up();
        */
    }
}
