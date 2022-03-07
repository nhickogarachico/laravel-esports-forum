<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'query_tag'
    ];

    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function tagCategory()
    {
        return $this->belongsTo(TagCategory::class);
    }

    public function tagsByCategory($categoryId, $limit = null)
    {
        return $this->where('tag_category_id', $categoryId)->limit($limit)->get();
    }

    public function tagsByCategoryCount($categoryId)
    {
        return $this->where('tag_category_id', $categoryId)->count();
    }
    
    public function getTag($queryTag)
    {
        return $this->where('query_tag', $queryTag)->withCount('posts')->first();
    }

    public function topPosts()
    {
        return $this->belongsToMany(Post::class)->withCount('likes')->orderBy('likes_count', 'DESC')->get();
    }

    public function mostReplies()
    {
        return $this->belongsToMany(Post::class)->withCount('comments')->orderBy('comments_count', 'DESC')->get();
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tag) {
            $tag->posts()->detach();
        });
    }
}
