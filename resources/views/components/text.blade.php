<div class="form-group mb-4">
    @if(isset($title))
        <label for="{{ $code }}"
               class="form-label {{ isset($titleBold) && $titleBold == true ? 'fw-bold' : '' }}">{{ $title }}</label>
    @endif
    <div class="col">
        <textarea @if(isset($placeholder)) placeholder="{{ $placeholder }}" @endif name="{{ $code }}" id="{{ $code }}" @if($disabled ?? false) disabled @endif class="form-control
            @error($code) is-invalid @enderror
        ">{{ old($code, $value) }}</textarea>
        @if(isset($hintMessage))
            <small>{!! $hintMessage !!}</small>
        @endif
        @if(isset($text))
            <span class="small">{{ $text }}</span>
        @endif
        @error($code)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
