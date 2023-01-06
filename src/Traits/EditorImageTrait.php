<?php

namespace Modular\Modular\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait EditorImageTrait
{
    public function uploadFile(UploadedFile $file, string $nameStrategy = 'originalUUID'): array
    {
        $readableName = $this->getReadableName($file);
        $fileName = $this->getFileName($file, $readableName, $nameStrategy);

        $file->storeAs(
            'editor-files',
            $fileName,
            'public',
        );

        return [
            'fileName' => $fileName,
            'filePath' => storage_path("app/public/editor-files/{$fileName}"),
            'fileUrl' => asset("storage/editor-files/{$fileName}"),
            'readableName' => $readableName,
        ];
    }

    private function getFileName(UploadedFile $file, string $readableName, string $nameStrategy): string
    {
        if ($nameStrategy == 'originalSlug') {
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
