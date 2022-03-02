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

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Mutator to add some random characters at the end of the slug to make it unique
    protected function slug() : Attribute
    {
        return Attribute::make(
            set: fn($value) => $value . "-" . Str::random(7)
        );
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            $post->tags()->detach();
        });
    }
}
