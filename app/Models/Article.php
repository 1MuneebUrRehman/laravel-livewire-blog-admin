<?php

namespace App\Models;

use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    /** @use HasFactory<ArticleFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'published_at',
        'status',
        'reading_time',
        'views',
        'is_featured'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function getFormattedViewsAttribute(): string
    {
        return number_format($this->views) . ' views';
    }

    public function getFormattedReadingTimeAttribute(): string
    {
        return $this->reading_time . ' min read';
    }

    public function isPublished(): bool
    {
        return $this->status === 'published' && $this->published_at <= now();
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopePopular($query, $limit = 10)
    {
        return $query->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->orderBy('views', 'desc')
            ->limit($limit);
    }

    public function scopeMostLiked($query, $limit = 10)
    {
        return $query->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->limit($limit);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = \Str::slug($article->title);
            }

            if ($article->status === 'published' && empty($article->published_at)) {
                $article->published_at = now();
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('status') && $article->status === 'published' && empty($article->published_at)) {
                $article->published_at = now();
            }
        });
    }
}
