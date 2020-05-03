<?php


namespace App\Services;

use Illuminate\Http\UploadedFile;
use Storage;

class FileService
{

    public function save(UploadedFile $file, $diskName = 'local', $fileName = null)
    {
        if ($fileName) {
            $path = Storage::disk($diskName)->putFileAs('', $file, $fileName);
        } else {
            $path = Storage::disk($diskName)->putFile('', $file);
        }
        return Storage::url($path);
    }

    public function remove(string $urlPath)
    {
        @unlink(Storage::path(preg_replace('/\\/storage\\//ui','' , $urlPath)));
    }

}