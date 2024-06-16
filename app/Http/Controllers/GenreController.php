<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;

/**
 * GenreController
 */
class GenreController extends Controller
{
    public function index(): ViewContract
    {
        $genres = Genre::query()->paginate(10);

        return View::make('admin.genre.index', compact('genres'));
    }

    public function create(): ViewContract
    {
        return View::make('admin.genre.form');
    }

    public function show(Genre $genre): ViewContract
    {
        return View::make('admin.genre.form', compact('genre'));
    }

    public function edit(Genre $genre): ViewContract
    {
        return View::make('admin.genre.form', compact('genre'));
    }

    /**
     * @param UpdateGenreRequest $request
     * @param Genre              $genre
     *
     * @return RedirectResponse
     */
    public function update(UpdateGenreRequest $request, Genre $genre): RedirectResponse
    {
        $genre->update((array) $request->validated());

        return redirect()->route('admin.genre.index', compact('genre'));
    }

    public function destroy(Genre $genre): RedirectResponse
    {
        $genre->delete();

        return redirect()->route('admin.genre.index');
    }

    public function store(CreateGenreRequest $request): RedirectResponse
    {
        Genre::create($request->validated());

        return redirect()->route('admin.genre.index');
    }
}
