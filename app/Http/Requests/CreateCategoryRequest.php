<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * CreateVideoRequest
 */
class CreateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name_ru'   => ['required', 'max:255'],
            'parent_id' => ['nullable'],
        ];
    }
}
