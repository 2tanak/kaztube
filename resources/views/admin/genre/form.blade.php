@extends('admin.templates.form')
@php
    /**
    * @var ?\App\Models\Genre $genre
    */
    $genre ??= null;
@endphp

@section('title')
    @if($genre)
        Редактирование жанра - ID: {{  $genre->id }}
    @else
        Добавление жанра
    @endif
@endsection

@section('formUrl', $genre ? route('admin.genre.update', $genre->id) : route('admin.genre.store'))

@section('formBody')
    @if($genre)
        @method('PATCH')
    @endif
    @foreach(config('app.available_locales') as $lang)
        @include('components.input', [
            'code'  => 'name_' . $lang,
            'title' => 'Название ' . $lang,
            'value' => $genre?->name,
        ])
    @endforeach
@endsection
