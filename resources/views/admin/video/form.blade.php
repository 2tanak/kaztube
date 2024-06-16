@extends('admin.templates.form')
@php
    /**
    * @var ?\App\Models\Video $video
    */
    $video ??= null;
@endphp

@section('title', $video ? 'Редактирование видео материала' : 'Загрузка видео материала')
@section('formUrl', $video ? route('admin.video.update', $video->id) : route('admin.video.store'))

@section('formBody')
    @if($video)
        @method('PUT')
    @endif
    <div class="col">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        @foreach(config('app.available_locales') as $lang)
                            @include('components.input', [
                                'code'  => 'title_' . $lang,
                                'value' => $video?->title,
                                'title' => 'Название ' . $lang,
                            ])
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        @include('components.select-array', [
                            'code'  => 'rubric_id',
                            'options' => $rubrics,
                            'value' => $video?->rubric_id,
                            'optionTitle' => 'name',
                            'title' => 'Рубрика',
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.select-array', [
                            'code'  => 'age_category_id',
                            'options' => $age_categories,
                            'value' => $video?->age_category_id,
                            'optionTitle' => 'mpaa',
                            'title' => 'Возрастная категория',
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.input', [
                            'code'        => 'film_year',
                            'value'       => $video?->film_year,
                            'title' => 'Год фильма',
                            'attributes' => [
                                'type'        => 'number',
                                'min' => '1800',
                                'max' => '2100',
                                'required' => 'required',
                            ],
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.input', [
                            'code'        => 'premiere_date',
                            'value'       => $video?->premiere_date,
                            'title' => 'Дата премьеры',
                            'attributes' => [
                                'type'       => 'date',
                                'required' => 'required',
                            ],
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.select-array', [
                          'code'  => 'genre_id',
                          'options' => $genres,
                          'value' => $video?->genre_id,
                          'title' => 'Жанр',
                          'optionTitle' => 'name',
                       ])
                    </div>
                    <div class="col-md-6">
                        @include('components.select-array', [
                            'code'  => 'category_id',
                            'options' => $categories,
                            'value' => $video?->category_id,
                            'optionTitle' => 'name',
                            'title' => 'Категория',
                            'attributes' => [
                                'required' => 'required',
                            ],
                        ])
                    </div>
                    @if($video)
                        <div class="col-md-6">
                            @include('components.input', [
                                'code'        => 'created_at',
                                'value'       => $video?->created_at->format('d.m.Y H:i:s'),
                                'title'       => 'Дата загрузки',
                                'attributes' => [
                                    'disabled' => 'disabled'
                                ],
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('components.input', [
                                'code'        => 'author_name',
                                'value'       => $video?->user->name,
                                'title' => 'Автор',
                                'attributes' => [
                                    'disabled' => 'disabled'
                                ],
                            ])
                        </div>
                    @endif
                    <div class="col-12">
                        <div class="mb-3">
                            @foreach(config('app.available_locales') as $lang)
                                @include('components.text', [
                                    'title' => 'Описание ' . $lang,
                                    'code'  => 'description_' . $lang,
                                    'value' => $video?->description,
                                ])
                            @endforeach
                        </div>
                        <div class="mb-3">
                            @include('components.input', [
                                'title' => 'Теги (через запятую)',
                                'code'        => 'tags',
                                'value'       => $video?->tags->pluck('title')->implode(','),
                            ])
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            @foreach(config('app.available_locales') as $lang)
                                @include('components.input', [
                                    'title' => 'Seo Заголовок ' . $lang,
                                    'code'  => 'seo_title_' . $lang,
                                    'value' => $video?->seo_title,
                                ])
                            @endforeach
                        </div>
                        <div class="mb-3">
                            @foreach(config('app.available_locales') as $lang)
                                @include('components.input', [
                                    'title' => 'Seo Ключевые слова ' . $lang,
                                    'code'  => 'seo_keywords_' . $lang,
                                    'value' => $video?->seo_keywords,
                                ])
                            @endforeach
                        </div>
                        <div class="mb-3">
                            @foreach(config('app.available_locales') as $lang)
                                @include('components.text', [
                                    'title' => 'Seo Описание ' . $lang,
                                    'code'  => 'seo_description_' . $lang,
                                    'value' => $video?->seo_description,
                                ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @include('components.files', [
                    'title' =>'Превью',
                    'code'  => 'preview_id',
                    'value' => '',
                    'type' => 'file'
                 ])
                @include('components.files', [
                    'title' =>'Файл обложки*',
                    'code'  => 'cover',
                    'value' => '',
                    'type' => 'file'
                 ])
                <upload-video input-name="video" input-label="Основной видео-файл (Фильм)"></upload-video>
                <upload-video input-name="trailer" input-label="Вторичный видео-файл (Трейлер)"></upload-video>
                @include('components.files', [
                    'title' =>'Файл субтитров',
                    'code'  => 'subtitle',
                    'value' => '',
                    'type' => 'file'
                ])
                @include('components.select-array', [
                    'code'  => '',
                    'options' => [
                        [
                            'name' => 'Прайс',
                            'value'=>''
                        ],
                        [
                            'name'  => 'Новости',
                            'value' => 'news'
                        ],
                     ],
                    'optionValue' => 'value',
                    'optionTitle' => 'name',
                    'value' => '',
                ])
                @include('components.select-array', [
                    'code'  => 'cat',
                    'options' => [
                        [
                            'name' => 'Статус',
                            'value'=>''
                        ],
                        [
                            'name' => 'Новости',
                            'value'=>'news'
                        ],
                     ],
                    'optionValue' => 'value',
                    'optionTitle' => 'name',
                    'value' => '',
                 ])
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="flexSwitchCheckDefault">Выводить на главной</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <script src="{{ asset('js/tinymce/tinymce.js') }}" referrerpolicy="origin"></script>--}}
{{--    <script>--}}
{{--        tinymce.init({--}}
{{--            selector: 'textarea#description_ru',--}}
{{--            branding: false,--}}
{{--            promotion: false,--}}
{{--            elementpath: false,--}}
{{--        });--}}
{{--    </script>--}}
@endsection
