<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Modular\Modular\Traits\EditorImageTrait;
use function PHPUnit\Framework\assertFileExists;

uses(EditorImageTrait::class);

beforeEach(function () {
    (new Filesystem)->deleteDirectory(storage_path('editor-files'));
});

afterAll(function () {
    (new Filesystem)->deleteDirectory(storage_path('editor-files'));
});

it('can upload a file to the default editor media file path', function () {
    $file = UploadedFile::fake()->image('A nice file.jpg');

    $result = $this->uploadFile($file, 'originalSlug');

    expect($result)->toHaveKeys(['fileName', 'filePath', 'fileUrl', 'readableName']);
    expect($result['fileName'])->toBe('a-nice-file.jpg');
    expect($result['readableName'])->toBe('A nice file');
    assertFileExists($result['filePath']);
});
