<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use App\Models\Reference\Category;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasUuids;
    protected $fillable = ['title', 'slug', 'thumbnail', 'content', 'description', 'author_id', 'category_id', 'status', 'is_publish', 'comment'];
    protected $casts = [
        'status' => ArticleStatus::class,
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
