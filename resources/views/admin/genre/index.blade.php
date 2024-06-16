@extends('admin.templates.list')
@php
    /**
     * @var \App\Models\Genre $genres
     */
@endphp
@section('title', 'Жанры')

@section('header')
    <a href="{{ route('admin.genre.create') }}" class="btn btn-primary">Создать</a>
@endsection

@section('body')
    <table class="table table-bordered mt-3">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Название</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($genres as $genre)
            <tr>
                <th scope="row">{{ $genre->id }}</th>
                <td>{{ $genre->name }}</td>
                <td>
                    @include('components.admin.edit-button', ['url' => route('admin.genre.edit', $genre->id)])
                    @include('components.admin.delete-button', ['url' => route('admin.genre.destroy', $genre->id)])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
