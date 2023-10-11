<?php

namespace Modules\Support\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait FileNameGenerator
{
    private function getFileName(UploadedFile $file, string $readableName, string $nameStrategy): string
    {
        if ($nameStrategy == 'original') {
            return Str::slug($readableName).'.'.$file->getClientOriginalExtension();
        }

        if ($nameStrategy == 'originalUUID') {
            return Str::slug($readableName).'-'.Str::uuid().'.'.$file->getClientOriginalExtension();
        }

        if ($nameStrategy == 'hash') {
            return $file->hashName();
        }
    }

    private function getReadableName(UploadedFile $file): string
    {
        return str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());
    }
}
