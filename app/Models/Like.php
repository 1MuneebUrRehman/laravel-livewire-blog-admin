<?php

namespace App\Models;

use Database\Factories\LikeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    /** @use HasFactory<LikeFactory> */
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getTopLikedArticles($limit = 10)
    {
        return self::selectRaw('article_id, COUNT(*) as like_count')
            ->groupBy('article_id')
            ->orderBy('like_count', 'desc')
            ->with('article')
            ->limit($limit)
            ->get();
    }
}
