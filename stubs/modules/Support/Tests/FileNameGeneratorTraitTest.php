<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Modules\Support\Traits\FileNameGenerator;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class, FileNameGenerator::class);

it('can set the name of a uploaded file', function () {
    $file = UploadedFile::fake()->image('A nice file.jpg');

    $readableName = $this->getReadableName($file);
    $fileName = $this->getFileName($file, $readableName, 'original');

    expect($fileName)->toBe('a-nice-file.jpg');
});
