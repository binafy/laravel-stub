<?php

use Binafy\LaravelStub\Facades\LaravelStub;

use function PHPUnit\Framework\assertFileDoesNotExist;
use function PHPUnit\Framework\assertFileExists;
use function PHPUnit\Framework\assertTrue;

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

    assertTrue($generate);
    assertFileExists(__DIR__ . '/../App/new-test.php');
    assertFileDoesNotExist(__DIR__ . '/../App/test.stub');
});

test('throw exception when stub path is invalid', function () {
    LaravelStub::from('test.stub')
        ->to(__DIR__ . '/../App')
        ->name('new-test')
        ->ext('php')
        ->generate();

    assertFileDoesNotExist(__DIR__ . '/../App/new-test.php');
    assertFileExists(__DIR__ . '/../App/test.stub');
})->expectExceptionMessage('The stub file does not exist, please enter a valid path.');

test('throw exception when destination path is invalid', function () {
    LaravelStub::from(__DIR__ . '/test.stub')
        ->to('App')
        ->name('new-test')
        ->ext('php')
        ->generate();

    assertFileDoesNotExist(__DIR__ . '/../App/new-test.php');
    assertFileExists(__DIR__ . '/../App/test.stub');
})->expectExceptionMessage('The given folder path is not valid.');

test('download the stub file', function () {
    $stub = __DIR__ . '/test.stub';

    $downloadInstance = LaravelStub::from($stub)
        ->to(__DIR__ . '/../App')
        ->replaces([
            'CLASS' => 'Milwad',
            'NAMESPACE' => 'App\Models'
        ])
        ->replace('TRAIT', 'HasFactory')
        ->name('new-test')
        ->ext('php')
        ->download();

    expect($downloadInstance)->toBeInstanceOf(\Symfony\Component\HttpFoundation\BinaryFileResponse::class);
    assertFileExists(__DIR__ . '/../App/new-test.php');
    assertFileDoesNotExist(__DIR__ . '/../App/test.stub');
});
