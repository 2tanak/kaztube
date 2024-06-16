<?php

namespace App\Http\Requests\Video;

/**
 * CreateVideoRequest
 */
class CreateVideoRequest extends BaseRequest
{
    public function rules(): array
    {
        return array_merge_recursive(parent::rules(), [
            'cover'   => ['required'],
            'video'   => ['required'],
            'trailer' => ['nullable'],
        ]);
    }
}
