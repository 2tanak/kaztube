@php
    /**
    * @var string $title
    * @var string $subTitle
    */
    $subTitle ??= '';
@endphp
<file-input
    id="{{ $application->id }}"
    :documents="{{ $application->documents()->where('type', $documentType->value)->get() }}"
    title="{{ $title }}"
    :sub-title='{!! is_string($subTitle) ? '"' . $subTitle . '"' : json_encode($subTitle) !!}'
    document-type="{{ $documentType->value }}"
    @error($documentType->value)
    validation-error="{{ $message }}"
    @enderror
></file-input>
