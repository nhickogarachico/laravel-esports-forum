<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    public function activitiable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activitiesPagination($userId, $currentPageNumber, $perPage)
    {
        $end = $perPage * $currentPageNumber;
        return $this->where('user_id', $userId)->orderBy('created_at', 'DESC')->limit($perPage)->offset($end - $perPage)->get();
    }
}
