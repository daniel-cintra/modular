<?php

namespace Modules\Support\Traits;

use Illuminate\Http\UploadedFile;

trait UploadFile
{
    use FileNameGenerator;

    public function uploadFile(string $inputFileName, string $path = 'user-files', string $nameStrategy = 'originalUUID', $disc = 'local'): array
    {
        $file = request()->file($inputFileName);

        if (! $file or ! $file instanceof UploadedFile) {
            return [];
        }

        $readableName = $this->getReadableName($file);
        $fileName = $this->getFileName($file, $readableName, $nameStrategy);

        $file->storeAs(
            $path,
            $fileName,
            $disc,
        );

        return [$inputFileName => $fileName];
    }
}
