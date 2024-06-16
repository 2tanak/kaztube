@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-uppercase mb-0">@yield('title')</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="@yield('formUrl')"
                      method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @yield('formBody')
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
