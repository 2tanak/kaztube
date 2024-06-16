@extends('admin.templates.form')
@php
    /**
    * @var ?\App\Models\User $user
    */
    $user ??= null;
@endphp

@section('title')
    @if($user)
        Редактирование пользователя - ID: {{  $user->id }}
    @else
        Добавление пользователя
    @endif
@endsection

@section('formUrl', $user ? route('admin.user.update', $user->id) : route('admin.user.store'))

@section('formBody')
    @if($user)
        @method('PATCH')
    @endif
    @include('components.input', [
        'code' => 'name',
        'value' => $user?->name,
        'title' => 'Имя'
    ])

    @include('components.input', [
        'code'        => 'password',
        'title'       => 'Пароль',
        'attributes' => [
            'type' => 'password',
        ],
    ])

    @include('components.input', [
        'code'        => 'email',
        'value'       => $user?->email,
        'title'      => 'E-mail',
        'attributes' => [
            'type' => 'email',
        ],
    ])

    @include('components.input', [
        'code'        => 'position',
        'value'       => $user?->position,
        'title'       => 'Должность',
    ])
@endsection
