<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChunkUploadRequest;
use App\Models\ChunkFile;
use App\Services\VideoUploadService;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * ChunkFileController
 */
class ChunkFileController extends Controller
{
    public function store(ChunkUploadRequest $request, VideoUploadService $uploadService): JsonResponse
    {
        /**
         * @var UploadedFile $chunk
         */
        $chunk = $request->getFile('file');

        $temp_dir = 'tmp/' . $request->resumableIdentifier;

        $fileName = $request->resumableFilename . '.part' . $request->resumableChunkNumber;

        Storage::makeDirectory($temp_dir);

        Debugbar::startMeasure('saveChunk');

        if (!$chunk->storeAs($temp_dir, $fileName)) {
            Log::error(sprintf(
                'Error saving (move_uploaded_file) chunk %s for file %s',
                $request->resumableChunkNumber,
                $request->resumableFilename
            ));
        }
        Debugbar::stopMeasure('saveChunk');

        $uploadedFilesCount = count(Storage::files($temp_dir));

        if ($uploadedFilesCount < $request->resumableTotalChunks) {
            return response()->json([
                'done'   => (int) round($uploadedFilesCount / $request->resumableTotalChunks),
                'status' => true,
            ]);
        }

        $mergedFilePath = 'tmp/' . $request->resumableFilename;

        /**
         * @var ChunkFile $chunkModel
         */
        $chunkModel = ChunkFile::create([
            'chunks_dir'   => $temp_dir,
            'merged_file'  => $mergedFilePath,
            'identifier'   => $request->resumableIdentifier,
            'total_chunks' => $request->resumableTotalChunks,
        ]);

        return response()->json([
            'done'     => 100,
            'status'   => true,
            'path'     => $mergedFilePath,
            'chunk_id' => $chunkModel->id,
        ]);
    }
}
