<!doctype html>
<html lang="{{app()->getLocale()}}" prefix="og:https://ogp.me/ns#">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>
        {{ __('KazTube') }}
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body id="body">
<div class="profile-page">
    <header class="page__header profile-page__header">
        <a href="{{ route('index') }}">
            <img class="header__logo" src="/img/logo.png" alt="Logo">
        </a>
        <div class="header__space"></div>
        <div class="header__auth">
            <a href="{{ route('login') }}">
                Админ
            </a>
        </div>
    </header>
    @include('layouts.components.left_menu')
    <main class="profile-page__content">@yield('content')</main>
</div>
<!-- Блок «Поделиться» от uSocial -->
<script async src="https://usocial.pro/usocial/usocial.js?uid=67db8c4032f70421&v=6.1.5" data-script="usocial" charset="utf-8"></script>
<!-- End Блок «Поделиться» -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
