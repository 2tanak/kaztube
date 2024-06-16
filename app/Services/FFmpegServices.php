<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * FFmpegServices
 */
class FFmpegServices
{
    final public function __construct()
    {
    }
    public static function call(): self
    {
        return new static();
    }

    /**
     * @param string $filePath
     * @param string $outputDir
     * @param int    $height
     *
     * @return bool
     */
    public static function resizeAndSaveVideo(string $filePath, string $outputDir, int $height): bool
    {
        if (!is_dir($outputDir)) {
            return false;
        }

        $outputFile = sprintf('%s/%s_%s.mp4', $outputDir, pathinfo($filePath, PATHINFO_FILENAME), $height);

        $cmd = sprintf(
            'ffmpeg -i %s -vf scale=-2:%s -c:a copy %s',
            escapeshellarg($filePath),
            $height,
            escapeshellarg($outputFile)
        );

        exec($cmd, $output, $returnCode);
        if ($returnCode !== 0) {
            return false;
        }
        return true;
    }

    /**
     * @psalm-suppress ForbiddenCode
     */
    public function runCommand(string $command): string|null|false
    {
        return shell_exec('ffmpeg' . $command);
    }

    /**
     * @return array{width: int, height: int, duration: int}
     *
     * @throws Exception
     */
    public static function getVideoMetadata(string $path): array
    {
        $url = Storage::path($path);

        if (!Storage::exists($path)) {
            throw new Exception('video file not exists');
        }

        $cmd = sprintf('ffprobe -v quiet -show_streams -of json "%s"', $url);

        $output = [];
        $exitCode = 0;
        exec($cmd, $output, $exitCode);

        if ($exitCode) {
            Log::error('Ошибка при получении метаданных видео', [
                'command'  => $cmd,
                'output'   => $output,
                'exitcode' => $exitCode,
            ]);
            throw new Exception('Ошибка при получении метаданных видео');
        }

        /**
         * @var array{streams: ?array<array{width: int, height: int, duration: int}>} $data
         */
        $data = json_decode(implode($output), true);

        if (empty($data['streams'])) {
            throw new Exception('video file not exists');
        }

        return $data['streams'][0];
    }
}
