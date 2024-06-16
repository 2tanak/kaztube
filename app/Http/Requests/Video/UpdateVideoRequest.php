<?php

namespace App\Http\Requests\Video;

/**
 * CreateVideoRequest
 */
class UpdateVideoRequest extends BaseRequest
{
    public function rules(): array
    {
        return array_merge_recursive(parent::rules(), [
            'cover' => ['sometimes'],
        ]);
    }
}
