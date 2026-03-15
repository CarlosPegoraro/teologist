<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class StudyMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'study_subject_id',
        'user_id',
        'title',
        'description',
        'type',
        'external_url',
        'file_path',
        'file_name',
        'file_extension',
        'file_size',
    ];

    protected $appends = [
        'file_url',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(StudySubject::class, 'study_subject_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFileUrlAttribute(): ?string
    {
        if (! $this->file_path) {
            return null;
        }

        return Storage::disk('public')->url($this->file_path);
    }
}
