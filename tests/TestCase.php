<?php

namespace Tests;

use Binafy\LaravelStub\Providers\LaravelStubServiceProvider;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Set up.
     */
    protected function setUp(): void
    {
        parent::setUp();

        File::put(__DIR__ . '/Feature/test.stub', '');
    }

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
