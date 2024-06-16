@extends('admin.templates.list')
@php
    /**
     * @var \App\Models\Rubric $rubrics
     */
@endphp
@section('title', 'Рубрики')

@section('header')
    <a href="{{ route('admin.rubric.create') }}" class="btn btn-primary">Создать</a>
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
        @foreach ($rubrics as $rubric)
            <tr>
                <th scope="row">{{ $rubric->id }}</th>
                <td>{{ $rubric->name }}</td>
                <td>
                    @include('components.admin.edit-button', ['url' => route('admin.rubric.edit', $rubric->id)])
                    @include('components.admin.delete-button', ['url' => route('admin.rubric.destroy', $rubric->id)])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
