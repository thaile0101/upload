<?php

namespace App\Services;


use App\Models\Media;
use Illuminate\Http\UploadedFile;

class UploadService
{
    private $media;

    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    /**
     * Saves the file
     *
     * @param UploadedFile $file
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveFile(UploadedFile $file)
    {
        $fileName = $this->createFilename($file);
        $extension = $file->getClientOriginalExtension();
        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());
        // Group files by the date (week
        $dateFolder = date("Y-m-W");

        // Build the file path
        $filePath = "upload/{$mime}/{$dateFolder}/";
        $finalPath = storage_path("app/".$filePath);

        $fullFilename = $fileName . '.' . $extension;
        // move the file name
        $file->move($finalPath, $fullFilename);
        $this->media->create([
            'name' => $fileName,
            'mime_type' => $mime,
            'url' => $filePath . $fullFilename
        ]);

        return response()->json([
            'path' => $filePath,
            'name' => $fullFilename,
            'mime_type' => $mime
        ]);
    }

    /**
     * Create unique filename for uploaded file
     * @param UploadedFile $file
     * @return string
     */
    public function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace(".".$extension, "", $file->getClientOriginalName()); // Filename without extension

        $index = 1;
        $baseName = $filename;
        while ($this->checkIfExistsName($filename)) {
            $filename = $baseName . '-' . $index++;
        }
        return $filename;
    }

    /**
     * @param $name
     * @return mixed
     * @author Thai Le
     */
    protected function checkIfExistsName($name)
    {
        $count = $this->media->where('name', '=', $name)->count();
        return $count > 0;
    }
}