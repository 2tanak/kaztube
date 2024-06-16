<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Категория
 *
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name_ru',
        'name_en',
        'name_kz',
        'parent_id',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getNameAttribute(): ?string
    {
        return match (app()->getLocale()) {
            'ru' => $this->name_ru,
            'kz' => $this->name_kz,
            'en' => $this->name_en,
        };
    }
}
