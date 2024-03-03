<?php

use Binafy\LaravelStub\Facades\LaravelStub;
use Illuminate\Http\UploadedFile;

test('generate stub successfully with all options', function () {
    $stub = UploadedFile::fake()->create('test.stub');

    LaravelStub::from($stub->path());
});
