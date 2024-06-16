<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRubricRequest;
use App\Http\Requests\UpdateRubricRequest;
use App\Models\Rubric;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;

/**
 * RubricController
 */
class RubricController extends Controller
{
    public function index(): ViewContract
    {
        $rubrics = Rubric::get();
        return View::make('admin.rubric.index', compact('rubrics'));
    }

    public function create(): ViewContract
    {
        return View::make('admin.rubric.form');
    }

    public function show(Rubric $rubric): ViewContract
    {
        return View::make('admin.rubric.form', compact('rubric'));
    }

    public function edit(Rubric $rubric): ViewContract
    {
        return View::make('admin.rubric.form', compact('rubric'));
    }

    public function update(UpdateRubricRequest $request, Rubric $rubric): RedirectResponse
    {
        $rubric->update((array) $request->validated());
        return redirect()->route('admin.rubric.index', compact('rubric'));
    }

    public function destroy(Rubric $rubric): RedirectResponse
    {
        $rubric->delete();
        return redirect()->route('admin.rubric.index');
    }

    public function store(CreateRubricRequest $request): RedirectResponse
    {
        Rubric::create($request->validated());

        return redirect()->route('admin.rubric.index');
    }
}
