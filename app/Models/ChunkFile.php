<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

/**
 * ChunkFile
 *
 * @mixin IdeHelperChunkFile
 */
class ChunkFile extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'chunks_dir',
        'merged_file',
        'identifier',
        'total_chunks',
    ];

    public function toUploaded(): UploadedFile
    {
        return new UploadedFile(storage_path('app/' . $this->merged_file), basename($this->merged_file));
    }
}
