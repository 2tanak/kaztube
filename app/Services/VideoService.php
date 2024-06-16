<?php

namespace App\Services;

use App\Http\Requests\Video\BaseRequest;
use App\Jobs\ProcessVideo;
use App\Models\ChunkFile;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Сервис для работы с видео
 */
class VideoService
{
    public function updateVideo(Video $video, BaseRequest $request): static
    {
        $video->fill((array) $request->validated());

        if (!$video->exists) {
            $video->author_id = User::current()->id;
        }

        $video->save();

        $this->storeVideoFile($video, (int) $request->get('trailer'), 'trailer');
        $this->storeVideoFile($video, (int) $request->get('video'), 'main');

        if ($request->hasFile('cover')) {
            $this->setCover($video, $request->getFile('cover'));
        }

        if ($request->hasFile('subtitle')) {
            $this->setSubtitles($video, $request->getFile('subtitle'));
        }

        $this->attachTags($video, $request->tags);

        return $this;
    }

    public function storeVideoFile(Video $video, int $chunkFileId, string $type): void
    {
        if (!$chunkFileId) {
            return;
        }

        $chunkFile = ChunkFile::findOrFail($chunkFileId);

        ProcessVideo::dispatch($video, $chunkFile, $type);
    }

    public function attachTags(Video $video, ?string $tagString): static
    {
        if (!$tagString) {
            return $this;
        }

        $tags = explode(',', $tagString);
        $tags = array_map('trim', $tags);

        $tagIds = [];

        foreach ($tags as $tag) {
            /**
             * @var Tag $tagModel
             */
            $tagModel = Tag::firstOrCreate(['title' => $tag]);
            $tagIds[] = $tagModel->id;
        }

        $video->tags()->sync($tagIds);

        return $this;
    }

    public function setCover(Video $video, ?UploadedFile $cover): static
    {
        $video->cover = $this->safelyReplaceFile($video->cover, $cover, 'images/covers');

        return $this;
    }

    public function setSubtitles(Video $video, ?UploadedFile $subtitles): static
    {
        $video->subtitle = $this->safelyReplaceFile($video->subtitle, $subtitles, 'subtitles');

        return $this;
    }

    public function safelyReplaceFile(?string $oldPath, ?UploadedFile $newFile, string $savePath): ?string
    {
        if (!$newFile) {
            return $oldPath;
        }

        $newPath = $newFile->store($savePath);

        if (!$newPath) {
            return $oldPath;
        }

        if ($oldPath) {
            Storage::delete($oldPath);
        }

        return $newPath;
    }
}
