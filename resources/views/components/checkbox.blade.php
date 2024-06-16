<div class="form-check d-flex mb-4">
    <input type="checkbox" name="{{ $code }}" id="{{ $code }}" value="1" {{ $value ?? old($code) == 1 ? 'checked' : ''}} @if($disabled ?? false) disabled @endif class="form-check-input">
    @if(isset($title))
        <label for="{{ $code }}" class="form-label">{{ $title }}</label>
    @endif
</div>
