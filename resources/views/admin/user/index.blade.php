@extends('admin.templates.list')

@section('title', 'Пользователи')

@section('header')
    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Добавить</a>
@endsection

@section('body')
    <table class="table table-hover text-nowrap">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>E-mail</th>
            <th>Статус</th>
            <th>Должность</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('admin.user.status', $user->id) }}" class="btn btn-primary">
                        @if($user->is_active == 1)
                            Активный
                        @else
                            Неактивный
                        @endif
                    </a>
                </td>
                <td>{{ $user->position }}</td>
                <td>
                    @include('components.admin.edit-button', ['url' => route('admin.user.edit', $user->id)])
                </td>
                <td>
                    @include('components.admin.delete-button', ['url' => route('admin.user.destroy', $user->id)])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
