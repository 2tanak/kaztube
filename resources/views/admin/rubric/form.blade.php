@extends('admin.templates.form')
@php
    /**
    * @var ?\App\Models\Rubric $rubric
    */
    $rubric ??= null;
@endphp

@section('title')
    @if($rubric)
        Редактирование рубрики - ID: {{ $rubric->id }}
    @else
        Добавление рубрики
    @endif
@endsection

@section('formUrl', $rubric ? route('admin.rubric.update', $rubric->id) : route('admin.rubric.store'))

@section('formBody')
    @if($rubric)
        @method('PATCH')
    @endif
    @foreach(config('app.available_locales') as $lang)
        @include('components.input', [
            'code'  => 'name_' . $lang,
            'title' => 'Название ' . $lang,
            'value' => $rubric?->name,
        ])
    @endforeach
@endsection

