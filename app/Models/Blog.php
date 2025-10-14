<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'about',
        'thumbnail',
        'author_id',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(BlogContent::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'blogs_categories');
    }
}
