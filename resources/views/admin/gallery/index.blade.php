@extends('admin.templates.form')
@section('css')
    <link href='/css/gallery.css' rel="stylesheet">
@endsection
@section('content')

    <div class="container">
        <div class="uploads_main">
            <br><br><br><br>
            <form action="{{route("gallery.store")}}" method="POST" enctype="multipart/form-data">
                <div class="row no-gutters">
                    <div class="col-6">
                        <div class="col-12">
                            <div class="mb-3">
                                @foreach(config('app.available_locales') as $lang)
                                    @include('components.input', [
                                        'code'  => 'title_' . $lang,
                                        'title' => 'Заголовок ' . $lang,
                                        'value' => '',
                                    ])
                                @endforeach
                                @error('title')
                                <span class="invalid" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row ">

                            <div class="col-md-6">
                                <div>
                                    <label for="title" class="form-label mt-3">@lang("forms.gallery.finance")</label>
                                        @include('components.select-array', [
                                            'code'  => 'finance',
                                            'options' => [
                                                [
                                                    'name' => 'Финансы',
                                                    'value'=>''
                                                ],
                                                [
                                                    'name' => '100',
                                                    'value'=>'100'
                                                ],
                                                [
                                                    'name'  => '100',
                                                    'value' => '100'
                                                ],
                                             ],
                                            'optionValue' => 'value',
                                            'optionTitle' => 'name',
                                            'value' => '',
                                        ])
                                    @error('finance')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="title"
                                           class="form-label mt-3">@lang("forms.gallery.market.biznes")</label>
                                    @include('components.select-array', [
                                            'code'  => 'biznes',
                                            'options' => [
                                                [
                                                    'name' => 'Бизнес маркетинг',
                                                    'value'=> ''
                                                ],
                                                [
                                                    'name'  => 'Бизнес маркетинг-1',
                                                    'value' => 'biznes-1'
                                                ],
                                                [
                                                    'name'  => 'Бизнес маркетинг-2',
                                                    'value' => 'biznes-2'
                                                ],
                                                [
                                                    'name'  => 'Бизнес маркетинг-3',
                                                    'value' => 'biznes-3'
                                                ],
                                             ],
                                            'optionValue' => 'value',
                                            'optionTitle' => 'name',
                                            'value' => '',
                                        ])
                                    @error('biznes')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="title"
                                           class="form-label mt-3">@lang("forms.gallery.language.label")</label>
                                    <select
                                            class="form-select form-select-lg"
                                            aria-label=".form-select-lg example"
                                            name="language"
                                    >
                                        <option selected hidden value="">@lang("forms.gallery.language.label")</option>
                                        <option value="ru">@lang("forms.gallery.language.ru")</option>
                                        <option value="en">@lang("forms.gallery.language.en")</option>
                                        <option value="kz">@lang("forms.gallery.language.kz")</option>
                                    </select>
                                    @error('language')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <label for="title" class="form-label mt-3">@lang("forms.gallery.age")</label>
                                    <select
                                            class="form-select form-select-lg"
                                            aria-label=".form-select-lg example"
                                            name="age"
                                    >
                                        <option selected hidden value="">@lang("forms.gallery.age")</option>
                                        <option value="18">18+</option>
                                        <option value="10">10</option>
                                        <option value="5">58</option>
                                    </select>
                                    @error('age')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="title" class="form-label mt-3">@lang("forms.gallery.date")</label>
                                    <input type="date" class="form-control" id="date" placeholder="">
                                </div>

                                <div>
                                    <label for="title" class="form-label mt-3">@lang("forms.gallery.author")</label>
                                    <select
                                            class="form-select form-select-lg"
                                            aria-label=".form-select-lg example"
                                            name="author"
                                    >
                                        <option selected hidden value="">@lang("forms.gallery.author")</option>
                                        <option value="1">Пушкин</option>
                                        <option value="2">Толстой</option>
                                        <option value="3">Андерсон</option>
                                    </select>
                                    @error('author')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div>
                                <label for="title" class="form-label mt-3">@lang("forms.gallery.text")</label>
                                <textarea class="w-100" name="text"></textarea>
                                @error('text')
                                <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <br><br>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="date" class="form-label">@lang("forms.gallery.image_date")</label>
                                <input type="date" name="datePhoto" class="form-control" id="date" placeholder="">
                            </div>
                        </div>
                        <input type="file" name="fileUpload[]" multiple>
                        @csrf
                        <div class="card-group">
                            @isset($images)
                                @if(count($images) > 0)
                                    @foreach($images as $image)

                                        <div class="card">
                                            <div class="card-body">
                                                <img style="width:150px" class="card-img-top"
                                                     src="{{ Storage::disk($image->disk)->url($image->path) }}">
                                            </div>
                                        </div>

                                    @endforeach
                                @endif
                            @endisset
                        </div>


                        <div>
                            <label for="title" class="form-label mt-3">@lang("forms.gallery.price")</label>
                            <select
                                    class="form-select form-select-lg "
                                    aria-label=".form-select-lg example"
                                    name="price"
                            >
                                <option selected hidden value="">@lang("forms.gallery.price")</option>
                                <option value="1000">1000</option>
                                <option value="2000">2000</option>
                                <option value="3000">3000</option>
                            </select>
                            @error('price')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label mt-3">@lang("forms.gallery.isPublish.label")</label>
                            <select
                                    class="form-select form-select-lg"
                                    aria-label=".form-select-lg example"
                                    name="publish"
                            >
                                <option selected hidden value="">@lang("forms.gallery.isPublish.label")</option>
                                <option value="1"> @lang("forms.gallery.isPublish.active")</option>
                                <option value="2">@lang("forms.gallery.isPublish.noActive")</option>
                            </select>
                            @error('publish')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label mt-3">@lang("forms.gallery.isHome.label")</label>
                            <select
                                    class="form-select form-select-lg"
                                    aria-label=".form-select-lg example"
                                    name="isHome"
                            >
                                <option selected hidden value="">@lang("forms.gallery.isHome.label")</option>
                                <option value="1">@lang("forms.gallery.isHome.active")</option>
                                <option value="2">@lang("forms.gallery.isHome.noActive")</option>
                            </select>
                            @error('isHome')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                @lang("buttons.main.send")
                            </button>

                            <button type="submit" class="btn btn-secondary">
                                @lang("buttons.main.remove")
                            </button>
                        </div>
                    </div>


                </div>
            </form>


        </div>

    </div>

@endsection


