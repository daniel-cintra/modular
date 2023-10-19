<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Modules\Support\Traits\EditorImage;

use function PHPUnit\Framework\assertFileExists;

uses(EditorImage::class);

beforeEach(function () {
    (new Filesystem)->deleteDirectory(storage_path('editor-files'));
});

afterAll(function () {
    (new Filesystem)->deleteDirectory(storage_path('editor-files'));
});

it('can upload an image to the default editor media file path', function () {
    $file = UploadedFile::fake()->image('A nice file.jpg');

    $result = $this->uploadImage($file, 'original');

    expect($result)->toHaveKeys(['fileName', 'filePath', 'fileUrl', 'readableName']);
    expect($result['readableName'])->toBe('A nice file');
    assertFileExists($result['filePath']);
});
