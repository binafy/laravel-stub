<?php

use Binafy\LaravelStub\Facades\LaravelStub;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\assertFalse;
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
        ->moveStub()
        ->generate();

    assertTrue($generate);
    assertFileExists(__DIR__ . '/../App/new-test.php');
    assertFileDoesNotExist(__DIR__ . '/../App/test.stub');
});

test('generate stub successfully with all options without any moving', function () {
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
    assertFileExists(__DIR__ . '/../Feature/test.stub');
});

test('throw exception when stub path is invalid', function () {
    LaravelStub::from('test.stub')
        ->to(__DIR__ . '/../App')
        ->name('new-test')
        ->ext('php')
        ->generate();

    assertFileDoesNotExist(__DIR__ . '/../App/new-test.php');
    assertFileExists(__DIR__ . '/../App/test.stub');
})->expectExceptionMessage('The test.stub stub file does not exist, please enter a valid path.');

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

test('generate stub successfully with without any replaces', function () {
    $stub = __DIR__ . '/test.stub';

    $generate = LaravelStub::from($stub)
        ->to(__DIR__ . '/../App')
        ->name('new-test')
        ->ext('php')
        ->moveStub()
        ->generate();

    assertTrue($generate);
    assertFileExists(__DIR__ . '/../App/new-test.php');
    assertFileDoesNotExist(__DIR__ . '/../App/test.stub');
});

test('generate stub successfully when all conditions are met', function () {
    $stub = __DIR__ . '/test.stub';

    $generate = LaravelStub::from($stub)
        ->to(__DIR__ . '/../App')
        ->replaces([
            'CLASS' => 'Milwad',
            'NAMESPACE' => 'App\Models'
        ])
        ->replace('TRAIT', 'HasFactory')
        ->conditions([
            'CONDITION_ONE' => true,
            'CONDITION_TWO' => true,
            'CONDITION_THREE' => fn () => false,
        ])
        ->name('conditional-test')
        ->ext('php')
        ->generate();

    assertTrue($generate);
    assertFileExists(__DIR__ . '/../App/conditional-test.php');

    $content = File::get(__DIR__ . '/../App/conditional-test.php');
    expect($content)
        ->toContain('public function handle(): void')
        ->and($content)
        ->toContain('public function users(): void')
        ->and($content)
        ->not
        ->toContain('public function roles(): void');
});

test('generate stub successfully when conditions are not met', function () {
    $stub = __DIR__ . '/test.stub';

    $testCondition = false;

    $generate = LaravelStub::from($stub)
        ->to(__DIR__ . '/../App')
        ->conditions([
            'CONDITION_ONE' => false,
            'CONDITION_TWO' => $testCondition,
            'CONDITION_THREE' => fn() => false,
        ])
        ->name('conditional-test-false')
        ->ext('php')
        ->generate();

    assertTrue($generate);
    assertFileExists(__DIR__ . '/../App/conditional-test-false.php');

    $content = File::get(__DIR__ . '/../App/conditional-test-false.php');
    expect($content)
        ->not->toContain('public function handle(): void')
        ->and($content)
        ->not->toContain('public function users(): void')
        ->and($content)
        ->not->toContain('public function roles(): void');
});

test('generate stub successfully when force is true', function () {
    $stub = __DIR__ . '/test.stub';

    LaravelStub::from($stub)
        ->to(__DIR__ . '/../App')
        ->replaces([
            'CLASS' => 'Milwad',
            'NAMESPACE' => 'App\Models'
        ])
        ->name('new-test')
        ->ext('php')
        ->moveStub()
        ->generate();

    $this->createStubFile();

    $generate = LaravelStub::from($stub)
        ->to(__DIR__ . '/../App')
        ->replaces([
            'CLASS' => 'Binafy',
            'NAMESPACE' => 'App\Models'
        ])
        ->name('new-test')
        ->ext('php')
        ->moveStub()
        ->generateForce();

    expect(file_get_contents(__DIR__ . '/../App/new-test.php'))
        ->toContain('Binafy')
        ->and(file_get_contents(__DIR__ . '/../App/new-test.php'))
        ->not->toContain('Milwad');

    assertTrue($generate);
    assertFileExists(__DIR__ . '/../App/new-test.php');
    assertFileDoesNotExist(__DIR__ . '/../App/test.stub');
});

test('generate stub successfully with `generateIf` method', function () {
    $stub = __DIR__ . '/test.stub';

    $generate = LaravelStub::from($stub)
        ->to(__DIR__ . '/../App')
        ->replaces([
            'CLASS' => 'Milwad',
            'NAMESPACE' => 'App\Models'
        ])
        ->name('new-test')
        ->ext('php')
        ->moveStub()
        ->generateIf(true);

    assertTrue($generate);
    assertFileExists(__DIR__ . '/../App/new-test.php');
    assertFileDoesNotExist(__DIR__ . '/../App/test.stub');
});

test('generate stub unsuccessfully with `generateIf` method', function () {
    $stub = __DIR__ . '/test.stub';

    $generate = LaravelStub::from($stub)
        ->to(__DIR__ . '/../App')
        ->replaces([
            'CLASS' => 'Milwad',
            'NAMESPACE' => 'App\Models'
        ])
        ->name('new-test')
        ->ext('php')
        ->generateIf(false);

    assertFalse($generate);
});

test('generate stub successfully with `generateUnless` method', function () {
    $stub = __DIR__ . '/test.stub';

    $generate = LaravelStub::from($stub)
        ->to(__DIR__ . '/../App')
        ->replaces([
            'CLASS' => 'Milwad',
            'NAMESPACE' => 'App\Models'
        ])
        ->name('new-test')
        ->ext('php')
        ->moveStub()
        ->generateUnless(false);

    assertTrue($generate);
    assertFileExists(__DIR__ . '/../App/new-test.php');
    assertFileDoesNotExist(__DIR__ . '/../App/test.stub');
});

test('generate stub unsuccessfully with `generateUnless` method', function () {
    $stub = __DIR__ . '/test.stub';

    $generate = LaravelStub::from($stub)
        ->to(__DIR__ . '/../App')
        ->replaces([
            'CLASS' => 'Milwad',
            'NAMESPACE' => 'App\Models'
        ])
        ->name('new-test')
        ->ext('php')
        ->generateUnless(true);

    assertFalse($generate);
});
