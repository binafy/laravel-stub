<?php

namespace Binafy\LaravelStub\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelStub extends Facade
{
    /**
     * Get facade accessor.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-stub';
    }
}
