<?php

namespace App\Utils;

use Exception;
use Intervention\Image\Facades\Image;

class FileUploader
{
    public function upload(object $file, string $filePath = 'uploads/', $width = null, $height = null): string|array
    {
        if (!file_exists($filePath)) {
            try {
                mkdir($filePath);
            } catch (Exception $e) {
            }
        }
        $fullNameExtension = trim($file->getClientOriginalName());
        $arr = preg_split('/\./', $fullNameExtension);
        $extension = array_pop($arr);
        $tempName = implode('.', $arr);
        $fileName = $tempName . '__' . uniqid() . '__' . '.' . $extension;
        $fullName = $filePath . $fileName;
        if (isset($width) && isset($height)) {
            Image::make($file)->resize($width, $height)->save($fullName);
        } else {
            $file->move($filePath, $fileName);
        }
        return $fileName;
    }
}
