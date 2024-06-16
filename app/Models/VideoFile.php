<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Video File
 *
 * @mixin IdeHelperVideoFile
 */
class VideoFile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<array-key, string>
     */
    protected $fillable = [
        'path',
        'mime',
        'size',
        'width',
        'height',
        'duration',
        'type',
        'video_id',
    ];

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
