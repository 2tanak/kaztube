<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use App\Models\Image;

/**
 * Class реализация загрузки изображения в базу и сохранение в storage
 */
class UploadPhoto
{
    /**
     * @param array<UploadedFile> $files
     *
     * @return bool
     * @noinspection PhpCastIsUnnecessaryInspection
     */
    public static function upload(array $files): bool
    {
        $dir       = sprintf('/%s/%s', '/images', Carbon::now()->format('Y/m/d'));
        $disk      = 'public';
        $dataImage = [];

        foreach ($files as $file) {
            $path        = $file->store($dir, $disk);
            $dataImage[] = ['disk' => $disk, 'path' => $path, 'mime_type' => $file->getClientMimeType(), 'dir' => $dir];
        }

        return (bool) Image::insert($dataImage);
    }
}
