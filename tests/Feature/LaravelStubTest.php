<?php

use Binafy\LaravelStub\Facades\LaravelStub;

test('generate stub successfully with all options', function () {
    $stub = __DIR__ . '/test.stub';

    $generate = LaravelStub::from($stub)
        ->to(__DIR__ . '/../App')
        ->replaces([
            'CLASS' => 'Milwad',
            'NAMESPACE' => 'App\Models'
        ])
        ->replace('TRAIT', 'HasFactory')
        ->name('new-test.stub')
        ->generate();

    \PHPUnit\Framework\assertTrue($generate);
    \PHPUnit\Framework\assertFileExists(__DIR__ . '/../App/new-test.stub');
    \PHPUnit\Framework\assertFileDoesNotExist(__DIR__ . '/../App/test.stub');
});
