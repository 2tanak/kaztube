@extends('layouts.html')

@section('content')
    <section class="video-page">
        <div class="video-page_main-video">
            <div class="video-page_main-video_container">
                <video width="800" height="450" controls="controls"
                       poster="https://rozabox.com/wp-content/uploads/2019/01/man-5846064_1920-735x400.jpg">
                    <source src="{{ route('video.stream', ['video' => $video->videoFiles()->first()->id]) }}" type='video/ogg; codecs="theora, vorbis"'>
                </video>
                <div class="video-page_info">
                    <div class="video-page_info_top">
                        <h1>{{ $video->title }}</h1>
                        <button type="button" class="btn share-btn" data-toggle="modal"
                                data-target="#exampleModalCenter">
                            {{ __('Поделиться') }}
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M8 8.87479C7.13462 8.87479 6.05487 9.28079 5.22012 9.74979C3.4465 10.7473 2.30899 12.751 2.16724 14.4162C2.14449 14.69 1.90562 14.9998 1.58362 14.9998C1.26162 14.9998 1 14.7382 1 14.4162C1 11.1743 1.301 8.58341 3.625 6.24979C4.41162 5.45966 5.65937 4.28016 8 3.73153V1.84941C8 1.61316 8.13561 1.39792 8.34911 1.29642C8.56261 1.19492 8.81549 1.22466 8.99837 1.37341C10.5016 2.59491 13.2937 4.86379 14.4627 5.81317C14.5966 5.92167 14.6754 6.08354 14.6789 6.25591C14.6815 6.42741 14.6089 6.59191 14.4794 6.70566C13.3244 7.71628 10.5296 10.161 9.01588 11.4858C8.83476 11.6442 8.57838 11.6818 8.35963 11.5829C8.14088 11.4832 8 11.2653 8 11.0247C8 10.0394 8 8.87479 8 8.87479Z"
                                      stroke="#545454"/>
                            </svg>
                        </button>
                    </div>
                    <p>{{ $video->description }}</p>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Поделиться') }}</h5>
                                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="shareUrl" value="{{ url()->current() }}" readonly>
                                <button id="copyButton" class="btn btn-primary">{{ __('Копировать') }}</button>
                                <span id="copyMessage" class="copy-message"></span>
                                <!-- uSocial -->
                                <div class="uSocial-Share" data-pid="63400fb3ca2afb19dc8e74575e172c6e" data-type="share"
                                     data-options="round-rect,style1,default,absolute,horizontal,size32,eachCounter0,counter0,nomobile,mobile_position_right"
                                     data-social="fb,vk,ok,twi,wa,telegram"></div>
                                <!-- /uSocial -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-page_related-videos">
            @foreach($related_videos as $video)
                <div class="video-page_related-videos_item mb-3">
                    <a href="{{ route('video.show', $video->id) }}">
                        <img src="https://rozabox.com/wp-content/uploads/2019/01/man-5846064_1920-735x400.jpg"
                             alt="poster">
                    </a>
                    <h4>{{ $video->title }}</h4>
                </div>
            @endforeach
        </div>
    </section>
@endsection
