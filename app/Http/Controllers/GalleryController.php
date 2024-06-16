<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;
use App\Services\UploadPhoto;
use App\Http\Requests\GalleryRequest;
use App\Models\Image;

/**
 * Class для тестирования формы загрузки изображений и для показа формы
 */
class GalleryController extends Controller
{
    public function index(): ViewContract
    {
        $images = Image::paginate(10);

        return View::make('admin.gallery.index', ['images' => $images]);
    }

    public function store(GalleryRequest $request): RedirectResponse
    {
        if ($request->fileUpload) {
            UploadPhoto::upload($request->fileUpload);
        }

        return redirect()
            ->route('gallery.index')
            ->with('success', trans('message.save.successMessage'));
    }
}
