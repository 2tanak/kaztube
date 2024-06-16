<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Рубрика
 *
 * @mixin IdeHelperRubric
 */
class Rubric extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name_ru',
        'name_en',
        'name_kz',
    ];

    public function getNameAttribute(): ?string
    {
        return match (app()->getLocale()) {
            'ru' => $this->name_ru,
            'kz' => $this->name_kz,
            'en' => $this->name_en,
        };
    }
}
