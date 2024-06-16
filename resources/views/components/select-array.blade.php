@php
    $nullable ??= false;
    $attributes ??= [];
    $optionValue ??= 'id';
@endphp
<div class="form-group mb-4">
    @if(isset($title))
        <label for="{{ $code }}" class="form-label">{{ $title }}</label>
    @endif
    <select name="{{ $code }}"
            id="{{ $code }}"
            class="
            form-control
            form-select
            @error($code) is-invalid @enderror
            "
    @foreach($attributes as $key => $value)
        {{$key}}="{{$value}}"
    @endforeach
    >
    @if($nullable)
        <option value="">Не выбрано</option>
    @endif
    @isset($placeholder)
        <option hidden> {{ $placeholder }}</option>
    @endisset
    @foreach($options as $option)
        <option
                @if($value == $option[$optionValue]) selected
                @endif
                value="{{ $option[$optionValue] }}"
        >
            {{ $option[$optionTitle] }}
        </option>
        @endforeach
        </select>
    @error($code)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
