<?php

namespace Tests;

use Binafy\LaravelStub\Providers\LaravelStubServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Get package providers.
     */
    protected function getPackageProviders($app): array
    {
        return [
            LaravelStubServiceProvider::class,
        ];
    }
}
