<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class для сохранения информации о файлах
 *
 * @mixin IdeHelperImage
 */
class Image extends Model
{
    use HasFactory;

    /**
     * @var String $table
     */
    protected $table = 'images';

    /**
     * @var array<string> $fillable
     */
    protected $fillable
        = [
            'disk',
            'path',
            'mime_type',
            'dir',
            'description',
            'name',
            'size',
        ];
}
