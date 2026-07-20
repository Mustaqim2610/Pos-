<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Upload
{
    /**
     * Upload file
     */
    public static function image(
        UploadedFile $file,
        string $folder = 'products'
    ): string {

        return $file->store(
            $folder,
            'public'
        );
    }

    /**
     * Update file
     */
    public static function replace(
        ?string $oldFile,
        UploadedFile $newFile,
        string $folder = 'products'
    ): string {

        if (
            $oldFile &&
            Storage::disk('public')->exists($oldFile)
        ) {
            Storage::disk('public')
                ->delete($oldFile);
        }

        return $newFile->store(
            $folder,
            'public'
        );
    }

    /**
     * Hapus file
     */
    public static function delete(
        ?string $file
    ): void {

        if (
            $file &&
            Storage::disk('public')->exists($file)
        ) {
            Storage::disk('public')
                ->delete($file);
        }
    }

    /**
     * URL gambar
     */
    public static function url(
        ?string $file
    ): string {

        if (!$file) {
            return asset(
                'images/no-image.png'
            );
        }

        return asset(
            'storage/' . $file
        );
    }
}