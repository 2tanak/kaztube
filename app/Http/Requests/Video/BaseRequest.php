<?php

namespace App\Http\Requests\Video;

use App\Models\ChunkFile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * VideoRequest
 *
 * @property-read ?string $tags
 */
class BaseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title_ru'        => ['nullable', 'string', 'max:255'],
            'title_kz'        => ['nullable', 'string', 'max:255'],
            'title_en'        => ['nullable', 'string', 'max:255'],
            'description_ru'  => ['nullable', 'string', 'max:1000'],
            'description_kz'  => ['nullable', 'string', 'max:1000'],
            'description_en'  => ['nullable', 'string', 'max:1000'],
            'genre_id'        => ['required', 'integer'],
            'category_id'     => ['nullable', 'integer'],
            'rubric_id'       => ['required', 'integer'],
            'cover'           => ['image', 'max:50000'],
            'subtitle'        => ['nullable', 'file', 'max:50000'],
            'film_year'       => ['required', 'integer'],
            'premiere_date'   => ['required', 'date'],
            'age_category_id' => ['required', 'integer'],
            'tags'            => ['nullable', 'string', 'max:1000'],
            'trailer'         => ['numeric', Rule::exists(ChunkFile::class, 'id')],
            'video'           => ['numeric', Rule::exists(ChunkFile::class, 'id')],
        ];
    }
}
