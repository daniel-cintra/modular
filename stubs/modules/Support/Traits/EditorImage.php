<?php

namespace Modules\Support\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

trait EditorImage
{
    use FileNameGenerator;

    public function uploadEditorImage(): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'file' => $this->getUploadImageValidationRules(),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        $fileAttributes = $this->uploadImage(request()->file('file'));

        return response()->json($fileAttributes);
    }

    protected function uploadImage(UploadedFile $file): array
    {
        $readableName = $this->getReadableName($file);
        $fileName = $this->getFileName($file, $readableName, $this->getUploadImageNameStrategy());

        $file->storeAs(
            $this->getUploadImagePath(),
            $fileName,
            'public',
        );

        return [
            'fileName' => $fileName,
            'filePath' => storage_path("app/public/{$this->getUploadImagePath()}/{$fileName}"),
            'fileUrl' => asset("storage/{$this->getUploadImagePath()}/{$fileName}"),
            'readableName' => $readableName,
        ];
    }

    private function getUploadImageValidationRules(): string
    {
        return property_exists($this, 'uploadImageValidationRules') ? $this->uploadImageValidationRules : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
    }

    private function getUploadImagePath(): string
    {
        return property_exists($this, 'uploadImagePath') ? $this->uploadImagePath : 'editor-files';
    }

    private function getUploadImageNameStrategy(): string
    {
        return property_exists($this, 'uploadImageNameStrategy') ? $this->uploadImageNameStrategy : 'originalUUID';
    }
}
