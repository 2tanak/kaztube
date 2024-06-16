@extends('layouts.profile')
@section('content')
    <h1>Панель управления</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col" colspan="2">Общая статистика сайта</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Общее количество публикаций</td>
            <td>11 254 854</td>
        </tr>
        <tr>
            <td>Публикации ожидающие проверки</td>
            <td>278</td>
        </tr>
        <tr>
            <td>Зарегистрированых пользователей</td>
            <td>8 547</td>
        </tr>
        <tr>
            <td>Размер базы данных</td>
            <td>4,2 мб</td>
        </tr>
        <tr>
            <td>Общий размер кэша</td>
            <td>315.35 Kb</td>
        </tr>
        </tbody>
    </table>
@endsection

