<?php

namespace Binafy\LaravelStub\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static from(string $path): static
 *
 * @see \Binafy\LaravelStub\LaravelStub
 */
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
