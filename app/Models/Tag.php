<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Теги
 *
 * @mixin IdeHelperTag
 */
class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<array-key, string>
     */
    protected $fillable = ['title'];

    /**
     * @return BelongsToMany
     */
    public function videos(): BelongsToMany
    {
        return $this->belongsToMany(Video::class, 'video_tags', 'tag_id', 'video_id');
    }
}
