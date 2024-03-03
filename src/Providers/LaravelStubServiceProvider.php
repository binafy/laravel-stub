<?php

namespace Binafy\LaravelStub\Providers;

use Binafy\LaravelStub\LaravelStub;
use Illuminate\Support\ServiceProvider;

class LaravelStubServiceProvider extends ServiceProvider
{
    /**
     * Boot providers.
     */
    public function boot(): void
    {
        $this->app->bind('laravel-stub', fn ($app) => new LaravelStub);
    }
}
