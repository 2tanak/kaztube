<?php

namespace App\Http\Controllers;

use App\Http\Requests\Video\CreateVideoRequest;
use App\Http\Requests\Video\UpdateVideoRequest;
use App\Models\AgeCategory;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Rubric;
use App\Models\Video;
use App\Models\VideoFile;
use App\Services\VideoService;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * VideoController
 */
class VideoController extends Controller
{
    public function __construct(protected VideoService $videoService)
    {
    }

    public function index(): ViewContract
    {
        $videos = Video::all();

        return View::make('admin.video.index', compact('videos'));
    }

    public function show(Video $video): ViewContract
    {
        $related_videos = Video::query()
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();
        return View::make('video.show', compact('video', 'related_videos'));
    }

    public function stream(VideoFile $video): StreamedResponse
    {
        return \Storage::response($video->path);
    }

    public function create(): ViewContract
    {
        return View::make('admin.video.form')
            ->with('categories', Category::all())
            ->with('rubrics', Rubric::all())
            ->with('genres', Genre::all())
            ->with('age_categories', AgeCategory::all());
    }

    public function store(CreateVideoRequest $request): RedirectResponse
    {
        $this->videoService->updateVideo(new Video(), $request);

        return redirect()->route('admin.video.index');
    }

    public function edit(Video $video): ViewContract
    {
        return View::make('admin.video.form')
            ->with('video', $video)
            ->with('categories', Category::all())
            ->with('rubrics', Rubric::all())
            ->with('genres', Genre::all())
            ->with('age_categories', AgeCategory::all());
    }

    public function update(UpdateVideoRequest $request, Video $video): RedirectResponse
    {
        $this->videoService->updateVideo($video, $request);

        return redirect()->route('admin.video.index');
    }
}
