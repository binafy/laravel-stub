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
        ->name('new-test')
        ->ext('php')
        ->generate();

    \PHPUnit\Framework\assertTrue($generate);
    \PHPUnit\Framework\assertFileExists(__DIR__ . '/../App/new-test.php');
    \PHPUnit\Framework\assertFileDoesNotExist(__DIR__ . '/../App/test.stub');
});

test('throw exception when stub path is invalid', function () {
    $generate = LaravelStub::from('test.stub')
        ->to(__DIR__ . '/../App')
        ->name('new-test')
        ->ext('php')
        ->generate();

    \PHPUnit\Framework\assertFileDoesNotExist(__DIR__ . '/../App/new-test.php');
    \PHPUnit\Framework\assertFileExists(__DIR__ . '/../App/test.stub');
})->expectExceptionMessage('The stub file does not exist, please enter a valid path.');

test('throw exception when destination path is invalid', function () {
    $generate = LaravelStub::from(__DIR__ . '/test.stub')
        ->to('App')
        ->name('new-test')
        ->ext('php')
        ->generate();

    \PHPUnit\Framework\assertFileDoesNotExist(__DIR__ . '/../App/new-test.php');
    \PHPUnit\Framework\assertFileExists(__DIR__ . '/../App/test.stub');
})->expectExceptionMessage('The given folder path is not valid.');
