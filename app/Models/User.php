<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'avatar'
    ];

    protected $hidden = [
        'password',
    ];


    public function posts() {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC')->withCount('likes');
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
    }

    protected function activities() {
        return $this->hasMany(Activity::class);
    }

    protected function likes() {
        return $this->hasMany(Like::class);
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::make($value)
        );
    }

    public function fetchUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {

            foreach($user->activities as $activity) {
                $activity->delete();
            }
            foreach($user->likes as $like) {
                $like->delete();
            }
            foreach($user->posts as $post) {
                $post->delete();
            }
           
            foreach($user->comments as $comment) {
                $comment->delete();
            }
        });
    }
}
