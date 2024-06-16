<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Валидация для файлов
 *
 * @property-read ?array<UploadedFile> $fileUpload
 */
class GalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return Bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'finance'      => ['sometimes', 'nullable', 'in:100,200,300'],
            'biznes'       => ['sometimes', 'nullable', 'in:biznes-1,biznes-2,biznes-3'],
            'language'     => ['sometimes', 'nullable', 'in:en,ru,kz'],
            'age'          => ['sometimes', 'nullable', 'in:18,10,5'],
            'author'       => ['sometimes', 'nullable', 'in:1,2,3'],
            'text'         => ['sometimes', 'nullable', 'min:500'],
            'price'        => ['sometimes', 'nullable', 'in:1000,2000,3000'],
            'publish'      => ['sometimes', 'nullable', 'in:1,2'],
            'isHome'       => ['sometimes', 'nullable', 'in:1,2'],
            'fileUpload'   => ['array'],
            'fileUpload.*' => ['mimes:jpg,jpeg,png'],
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'finance'  => trans('forms.gallery.attribute.finance'),
            'title'    => trans('forms.gallery.attribute.title'),
            'biznes'   => trans('forms.gallery.attribute.biznes'),
            'language' => trans('forms.gallery.attribute.language'),
            'age'      => trans('forms.gallery.attribute.age'),
            'author'   => trans('forms.gallery.attribute.author'),
            'text'     => trans('forms.gallery.attribute.text'),
            'price'    => trans('forms.gallery.attribute.price'),
            'publish'  => trans('forms.gallery.attribute.publish'),
            'isHome'   => trans('forms.gallery.attribute.isHome'),
        ];
    }
}
