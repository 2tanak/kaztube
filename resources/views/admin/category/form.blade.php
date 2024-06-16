@extends('admin.templates.form')
@php
    /**
    * @var ?\App\Models\Category $category
    */
    $category ??= null;
@endphp

@section('title')
    @if($category)
        Редактирование категории - ID: {{  $category->id }}
    @else
        Добавление категории
    @endif
@endsection

@section('formUrl', $category ? route('admin.category.update', $category->id) : route('admin.category.store'))

@section('formBody')
    @if($category)
        @method('PATCH')
    @endif
    @foreach(config('app.available_locales') as $lang)
        @include('components.input', [
            'code'  => 'name_' . $lang,
            'title' => 'Название ' . $lang,
            'value' => $category?->name,
        ])
    @endforeach
@endsection
