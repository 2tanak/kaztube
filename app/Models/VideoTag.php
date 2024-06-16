<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Связующая таблица Видео и Теги
 *
 * @mixin IdeHelperVideoTag
 */
class VideoTag extends Model
{
    use HasFactory;
}
