<?php

namespace App\Trait;

use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    private function uploadFile($file, $disk = 'avatar')
    {

        // get file extension
        $extension = $file->getClientOriginalExtension();
        // set file name
        $fileName = time() . '.' . $extension;
        // set file path
        $filePath = $disk . '/' . $fileName;
        // jika folder avatar tidak ada maka buat folder avatar
        if (!Storage::disk('public')->exists($disk)) {
            Storage::disk('public')->makeDirectory($disk);
        }
        Storage::disk('public')->put($filePath, file_get_contents($file));
        return $filePath;
        // update photo in database
    }
}
