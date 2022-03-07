<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagCategory extends Model
{
    use HasFactory;

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function tagCategoryById($tagCategoryId)
    {
        return $this->where('id', $tagCategoryId)->first();
    }

}
