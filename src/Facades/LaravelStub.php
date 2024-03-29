<?php

namespace Binafy\LaravelStub\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static from(string $path): static
 * @method static to(string $to): static
 * @method static name(string $name): static
 * @method static ext(string $ext): static
 * @method static replace(string $key, mixed $value): static
 * @method static replaces(array $replaces): static
 * @method static download(): mixed
 * @method static generate(): bool
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
