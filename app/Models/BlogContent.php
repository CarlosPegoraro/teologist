<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogContent extends Model
{
    use HasFactory;

    protected $table = 'blogs_contents';

    public $timestamps = false;

    protected $fillable = [
        'content',
        'order',
        'blog_id',
    ];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
}
