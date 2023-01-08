<?php

namespace Modular\Modular\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

trait EditorImage
{
    use FileNameGenerator;

    public function uploadEditorImage(): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        $file = request()->file('image');
        $fileAttributes = $this->uploadImage($file);

        return response()->json($fileAttributes);
    }

    private function uploadImage(UploadedFile $file, string $nameStrategy = 'originalUUID'): array
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
