<?php

namespace Modular\Modular\Traits;

use Illuminate\Http\UploadedFile;

trait EditorImage
{
    use FileNameGenerator;

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
}
