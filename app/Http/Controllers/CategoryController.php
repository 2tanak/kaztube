<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;

/**
 * CategoryController
 */
class CategoryController extends Controller
{
    public function index(): ViewContract
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->get();

        return View::make('admin.category.index', compact('categories'));
    }

    public function create(): ViewContract
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->get();

        return View::make('admin.category.form', compact('categories'));
    }

    public function show(Category $category): ViewContract
    {
        return View::make('admin.category.form', compact('category'));
    }

    public function edit(Category $category): ViewContract
    {
        return View::make('admin.category.form', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update((array) $request->validated());

        return redirect()->route('admin.category.index', compact('category'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.category.index');
    }

    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.category.index');
    }
}
