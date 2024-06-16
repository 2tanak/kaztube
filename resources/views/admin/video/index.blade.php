@extends('admin.templates.list')

@section('title', 'Модерация видео')

@section('header')
    <a href="{{ route('admin.video.create') }}" class="btn btn-primary">Добавить</a>
@endsection

@section('body')
    <table class="table table-bordered mt-3">
        <thead>
        <tr>
            <th colspan="5" scope="col">
                Список публикаций на сайте
            </th>
            <th scope="col">Фильтр</th>
        </tr>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Дата</th>
            <th scope="col">Заголовок</th>
            <th scope="col">Категория</th>
            <th scope="col">Автор</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($videos as $video)
            <tr>
                <th scope="row">{{ $video->id }}</th>
                <td>{{ $video->created_at }}</td>
                <td>{{ $video->title }}</td>
                <td>{{ $video->category->name ?? '' }}</td>
                <td>{{ $video->user->name }}</td>
                <td>
                    @include('components.admin.edit-button', ['url' => route('admin.video.edit', $video->id)])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
