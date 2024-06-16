<div class="mb-3">
    @if(isset($title))
        <label for="{{ $code }}" class="form-label">
            {{ $title }}
            @if(isset($required))
                <span style="color: red">*</span>
            @endif
        </label>
    @endif
    <input class="form-control @error($code) is-invalid @enderror" type="file" id="{{ $code }}" name="{{ $code }}">
    @error($code)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
