<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Video
 *
 * @mixin IdeHelperVideo
 */
class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<array-key, string>
     */
    protected $fillable = [
        'title_ru',
        'title_kz',
        'title_en',
        'description_ru',
        'description_kz',
        'description_en',
        'file_kz',
        'file_ru',
        'file_en',
        'is_active',
        'rubric_id',
        'genre_id',
        'category_id',
        'age_category_id',
        'author_id',
        'cover',
        'subtitle',
        'premiere_date',
        'film_year',
        'seo_title_kz',
        'seo_title_en',
        'seo_title_ru',
        'seo_keywords_ru',
        'seo_keywords_en',
        'seo_keywords_kz',
        'seo_description_ru',
        'seo_description_en',
        'seo_description_kz',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function videoFiles(): HasMany
    {
        return $this->hasMany(VideoFile::class);
    }

    /**
     * @return BelongsTo
     */
    public function rubric(): BelongsTo
    {
        return $this->belongsTo(Rubric::class, 'rubric_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function ageCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'age_category_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function getTitleAttribute(): ?string
    {
        return match (app()->getLocale()) {
            'ru' => $this->title_ru,
            'kz' => $this->title_kz,
            'en' => $this->title_en,
        };
    }

    public function getDescriptionAttribute(): ?string
    {
        return match (app()->getLocale()) {
            'ru' => $this->description_ru,
            'kz' => $this->description_kz,
            'en' => $this->description_en,
        };
    }

    public function getSeoTitleAttribute(): ?string
    {
        return match (app()->getLocale()) {
            'ru' => $this->seo_title_ru,
            'kz' => $this->seo_title_kz,
            'en' => $this->seo_title_en,
        };
    }

    public function getSeoKeywordsAttribute(): ?string
    {
        return match (app()->getLocale()) {
            'ru' => $this->seo_keywords_ru,
            'kz' => $this->seo_keywords_kz,
            'en' => $this->seo_keywords_en,
        };
    }

    public function getSeoDescriptionAttribute(): ?string
    {
        return match (app()->getLocale()) {
            'ru' => $this->seo_description_ru,
            'kz' => $this->seo_description_kz,
            'en' => $this->seo_description_en,
        };
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'video_tags', 'video_id', 'tag_id');
    }
}
