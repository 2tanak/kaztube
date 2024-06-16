<?php

namespace App\Jobs;

use App\Models\ChunkFile;
use App\Models\Video;
use App\Models\VideoFile;
use App\Services\FFmpegServices;
use App\Services\VideoUploadService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

/**
 * Обработка видео после загрузки
 */
class ProcessVideo implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Video $video,
        protected ChunkFile $chunkFile,
        protected string $type,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(VideoUploadService $uploadService): void
    {
        $uploadService->mergeChunks($this->chunkFile);

        $filePath    = $this->chunkFile->merged_file;
        $newFilePath = sprintf(
            'videos/%s/%s',
            Carbon::now()->format('Y/m/d'),
            $this->chunkFile->toUploaded()->hashName(),
        );

        Storage::move($filePath, $newFilePath);

        $filePath = $newFilePath;

        $videoMetadata = FFmpegServices::getVideoMetadata($filePath);

        $videoFile = new VideoFile([
            'video_id' => $this->video->id,
            'mime'     => Storage::mimeType($filePath),
            'path'     => $filePath,
            'size'     => Storage::size($filePath),
            'width'    => $videoMetadata['width'],
            'height'   => $videoMetadata['height'],
            'duration' => $videoMetadata['duration'],
            'type'     => $this->type,
        ]);

        $videoFile->save();
    }
}
