@extends('layouts.profile')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">{{ __('Мои видео') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($videos as $video)
                <div class="col-sm-3">
                    <a href="https://i.ytimg.com/vi/CfV05mviqZo/maxresdefault.jpg" data-title="sample 1 - white" data-gallery="gallery">
                        <img src="https://i.ytimg.com/vi/CfV05mviqZo/maxresdefault.jpg" class="img-fluid mb-2" alt="white sample">
                        <p class="text-center">{{ $video->title }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
