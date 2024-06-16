@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase mb-0">@yield('title')</h5>
            </div>
            <div class="card-header">
                @yield('header')
            </div>
            <div class="card-body">
                @yield('body')
            </div>
        </div>
    </div>
@endsection
