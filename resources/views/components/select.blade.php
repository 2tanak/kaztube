<div class="form-group mb-4">
    @if(isset($title))
        <label for="{{ $code }}" class="form-label">{{ $title }}</label>
    @endif

    <div class="col">
        <select name="{{ $code }}" id="{{ $code }}" class="form-select @error($code) is-invalid @enderror" @if($disabled ?? false) disabled @endif>
            @if(isset($defaultTitle))
                <option value="{{ $defaultValue ?? null }}">{{ $defaultTitle }}</option>
            @endif
            @foreach($options as $option)
                <option value="{{ $option->{$optionValue} }}"
                    {{ (!empty(old($code)) ? old($code) : $value) == $option->{$optionValue} ? 'selected' : '' }}
                >{{ $option->{$optionTitle} }}</option>
            @endforeach
        </select>
        @error($code)
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
