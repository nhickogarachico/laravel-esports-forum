<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'user_id'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->withCount('likes');
    }

    public function latestComment()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC')->first();
    }
    public function activities()
    {
        return $this->morphMany(Activity::class, 'activitiable');
    }

    public function topPosts()
    {
        return $this->withCount('likes')->orderBy('likes_count', 'DESC')->orderBy('created_at', 'DESC')->get();
    }

    public function mostReplies()
    {
        return $this->withCount('comments')->orderBy('comments_count', 'DESC')->orderBy('created_at', 'DESC')->get();
    }


    // Mutator to add some random characters at the end of the slug to make it unique
    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value . "-" . Str::random(7)
        );
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            $post->tags()->detach();

            foreach ($post->comments as $comment) {
                $comment->delete();
            }
            foreach ($post->activities as $activity) {
                $activity->delete;
            }
            foreach ($post->likes as $like) {
                $like->delete();
            }
        });
    }
}
