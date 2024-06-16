@extends('layouts.html')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">{{ __('Видео') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-sm-3 mb-2">
                        <h5>
                            <a href="{{ route('video.show', $video->id) }}">
                                <img src="https://i.ytimg.com/vi/CfV05mviqZo/maxresdefault.jpg" class="img-fluid mb-2" alt="white sample">
                                <span class="text-center">{{ $video->title }}</span>
                            </a>
                        </h5>
                        <span class="text-secondary">{{ $video->user->name  }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
