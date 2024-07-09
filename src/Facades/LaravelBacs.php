<?php

namespace LaravelBacs\LaravelBacs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaravelBacs\LaravelBacs\LaravelBacs
 */
class LaravelBacs extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \LaravelBacs\LaravelBacs\LaravelBacs::class;
    }
}
