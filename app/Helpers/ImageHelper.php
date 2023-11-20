<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Upload an image and return the storage path.
     *
     * @param string $image
     * @return string|null
     */
    public static function upload($imagePath)
    {
        // Validate or process the path as needed
        if (!file_exists($imagePath)) {
            return null;
        }

        // Move the file to the storage path
        return Storage::putFileAs('public/images', $imagePath, basename($imagePath));
    }
}
