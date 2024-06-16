@extends('admin.templates.list')
@php
    /**
     * @var \App\Models\Category $categories
     */
@endphp
@section('title', 'Категории')

@section('header')
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Создать</a>
@endsection

@section('body')
    <div>
        @foreach($categories as $category)
            <div class="ms-1 mb-2" style="border: 1px solid #DDDDDD;">
                {{ 'ID ' . $category->id . ' ' . $category->name}}
                @include('components.admin.edit-button', ['url' => route('admin.category.edit', $category->id)])
                @include('components.admin.delete-button', ['url' => route('admin.category.destroy', $category->id)])
            </div>
            @foreach($category->categories as $child)
                <div class="ms-1 mb-2 ms-4" style="border: 1px solid #DDDDDD">
                    {{ 'ID ' . $child->id . ' ' . $child->name}}
                    @include('components.admin.edit-button', ['url' => route('admin.category.edit', $child->id)])
                    @include('components.admin.delete-button', ['url' => route('admin.category.destroy', $child->id)])
                </div>
            @endforeach
        @endforeach
    </div>
@endsection

