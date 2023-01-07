<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Modular\Modular\Traits\FileNameGenerator;

beforeEach(function () {
    (new Filesystem)->deleteDirectory(storage_path('editor-files'));
});

afterAll(function () {
    (new Filesystem)->deleteDirectory(storage_path('editor-files'));
});

uses(FileNameGenerator::class);

it('can set the name of a uploaded file', function () {
    $file = UploadedFile::fake()->image('A nice file.jpg');

    $readableName = $this->getReadableName($file);
    $fileName = $this->getFileName($file, $readableName, 'original');

    expect($fileName)->toBe('a-nice-file.jpg');
});
