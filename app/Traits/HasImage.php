<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasImage
{
    public function uploadImage(
        $file,
        string $folder = 'products'
    ): string {

        return $file->store(
            $folder,
            'public'
        );
    }

    public function updateImage(
        $oldImage,
        $newFile,
        string $folder = 'products'
    ): string {

        if ($oldImage) {
            Storage::disk('public')
                ->delete($oldImage);
        }

        return $newFile->store(
            $folder,
            'public'
        );
    }

    public function deleteImage(
        ?string $image
    ): void {

        if (
            $image &&
            Storage::disk('public')->exists($image)
        ) {
            Storage::disk('public')
                ->delete($image);
        }
    }

    public function imageUrl(
        ?string $image
    ): string {

        if (!$image) {
            return asset(
                'images/no-image.png'
            );
        }

        return asset(
            'storage/' . $image
        );
    }
}