<?php

namespace App\Services;

use App\Models\ChunkFile;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Storage;

/**
 * Сервис загрузки видео
 */
class VideoUploadService
{
    /**
     * @throws \Exception
     */
    public function mergeChunks(ChunkFile $chunkFile): void
    {
        Debugbar::startMeasure('mergeChunks');

        $fp = fopen(storage_path('app/' . $chunkFile->merged_file), 'w');

        if ($fp === false) {
            throw new \Exception('cannot create the destination file');
        }

        for ($i = 1; $i <= $chunkFile->total_chunks; $i++) {
            $chunk = Storage::get(sprintf(
                '%s/%s.part%d',
                $chunkFile->chunks_dir,
                basename($chunkFile->merged_file),
                $i
            ));

            if (!$chunk) {
                throw new \Exception('File part is missing');
            }

            fwrite($fp, $chunk);
        }

        fclose($fp);

        if (Storage::move($chunkFile->chunks_dir, $chunkFile->chunks_dir . '_UNUSED')) {
            Storage::deleteDirectory($chunkFile->chunks_dir . '_UNUSED');
        } else {
            Storage::deleteDirectory($chunkFile->chunks_dir);
        }

        Debugbar::stopMeasure('mergeChunks');
    }
}
