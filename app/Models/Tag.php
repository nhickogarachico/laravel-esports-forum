<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $orderBy;
    protected $fillable = [
        'tag',
        'query_tag'
    ];

    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function postsPagination($currentPageNumber, $perPage, $sortby, $sortdirection)
    {
        $end = $perPage * $currentPageNumber;
        switch ($sortby) {
            case "latest":
                $this->orderBy = "latest_comment";
                break;
            case "title":
                $this->orderBy = "title";
                break;
            case "recent":
                $this->orderBy = "created_at";
                break;
            case "likes":
                $this->orderBy = "likes_count";
                break;
            case "replies":
                $this->orderBy = "comments_count";
                break;
            default:
                $this->orderBy = "created_at";
        }

        switch ($sortdirection) {
            case null:
                $sortdirection = "desc";
                break;
            case "asc":
                break;
            case "desc":
                break;
            default:
                $sortdirection = "desc";
        }

        return $this->belongsToMany(Post::class)
        ->addSelect(['latest_comment' => Comment::select('created_at')
            ->whereColumn('post_id', 'posts.id')
            ->orderBy('created_at', $sortdirection)
            ->limit(1)])
        ->withCount('likes')
        ->withCount('comments')
        ->orderBy($this->orderBy, $sortdirection)
        ->limit($perPage)
        ->offset($end - $perPage)->get();
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
