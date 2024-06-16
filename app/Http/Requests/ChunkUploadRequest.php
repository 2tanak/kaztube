<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Запрос на загрузку чанка файла
 *
 * @property-read string $resumableIdentifier
 * @property-read string $resumableFilename
 * @property-read int    $resumableChunkNumber
 * @property-read int    $resumableTotalChunks
 */
class ChunkUploadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'resumableIdentifier'  => ['required', 'string'],
            'resumableFilename'    => ['required', 'string'],
            'resumableChunkNumber' => ['required', 'numeric'],
            'resumableTotalChunks' => ['required', 'numeric'],
            'file'                 => ['required', 'file', 'max:20000'],
        ];
    }
}
