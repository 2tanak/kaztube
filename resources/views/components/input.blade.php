@php
    $attributes ??= [];
    $type = $attributes['type'] ?? 'text';
    $title ??= '';
    $attributes['placeholder'] ??= $title;
@endphp
<div class="form-group mb-4 {{ $type == 'date' ? 'form-date' : '' }}">
    @if(!empty($title))
        <label for="{{ $code }}" class="form-label">
            {{ $title }}
            @if($attributes['required'] ?? false)
                *
            @endif
        </label>
    @endif
    <div class="col">
        <input type="{{ $type }}"
               name="{{ $code }}"
               id="{{ $code }}"
               @if($type !== 'password')
                   value="{{ old($code, $value) }}"
               @endif
               class="form-control mt-0
            @error($code) is-invalid @enderror
            @if($type == 'date') input-date @endif"

        @foreach($attributes as $key => $value)
            {{$key}}="{{$value}}"
        @endforeach
        @if($type == 'date')
            max="{{ '2100-12-31'}}"
        @endif
        >

        @if(isset($text))
            <span class="small-text">{{ $text }}</span>
        @endif

        @error($code)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
