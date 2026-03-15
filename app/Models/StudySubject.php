<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudySubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'related_course',
        'science_field',
        'description',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function materials(): HasMany
    {
        return $this->hasMany(StudyMaterial::class)->latest();
    }
}
