<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'post_id',
        'user_id',
        'parent_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'activitiable');
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($comment) {
            foreach ($comment->replies as $reply) {
                $reply->delete();
            }
            foreach ($comment->likes as $like) {
                $like->delete();
            }
        });
    }
}
