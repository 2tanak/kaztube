<!doctype html>
<html lang="{{app()->getLocale()}}" prefix="og:https://ogp.me/ns#">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body id="body">
<div class="profile-page">
    <header class="page__header profile-page__header">
        <a href="{{ route('index') }}">
            <img class="header__logo" src="/img/logo.png" alt="Logo">
        </a>
        <div class="header__space"></div>
        <div class="header__langs">
            <a href="#">RU</a>
            <a href="#">KZ</a>
            <a href="#">EN</a>
        </div>
    </header>
    <aside class="profile-page__sidebar">
        <div class="list-group">
            <a href="{{ route('admin.index') }}" class="list-group-item list-group-item-action active"
               aria-current="true">
                Главная
            </a>
            <a href="{{ route('admin.video.index') }}" class="list-group-item list-group-item-action">Модерация материалов</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Мой профиль</a>
            <a href="{{ route('personal-video.index') }}" class="list-group-item list-group-item-action">Мои видео</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Мои изображения</a>
            <a href="{{ route('admin.category.index') }}" class="list-group-item list-group-item-action">Категории</a>
            <a href="{{ route('admin.rubric.index') }}" class="list-group-item list-group-item-action">Рубрики</a>
            <a href="{{ route('admin.genre.index') }}" class="list-group-item list-group-item-action">Жанры</a>
            <a href="{{ route('gallery.index') }}" class="list-group-item list-group-item-action">Фотогаллерея</a>
            <a href="{{ route('admin.user.index') }}" class="list-group-item list-group-item-action">Пользователи</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Мониторинг</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Монетизация</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Настройки</a>
            <a href="{{route('logout')}}" class=list-group-item list-group-item-action">Выйти</a>
        </div>
    </aside>
    <div id="app">
        <main class="profile-page__content">@yield('content')</main>
    </div>
</div>


<script src="{{asset('js/app.js')}}" defer></script>

</body>
</html>
