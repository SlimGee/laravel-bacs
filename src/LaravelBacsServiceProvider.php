<?php

namespace LaravelBacs\LaravelBacs;

use LaravelBacs\LaravelBacs\Commands\LaravelBacsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelBacsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-bacs')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoute('api')
            ->hasMigration('create_laravel-bacs_table')
            ->hasCommand(LaravelBacsCommand::class);
    }
}
