<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    protected $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function likePost($postSlug)
    {
        
        $like = new Like(["user_id" => Auth::id()]);

        $post = $this->post->where('slug', $postSlug)->first();
         $post->likes()->save($like);

    }

    public function getPostLikeData($postSlug)
    {
        $post = $this->post->where('slug', $postSlug)->withCount('likes')->first();
        $likes = $post->likes->where('user_id', Auth::id())->count();
        
        return response()->json([
            'likesCount' => $post->likes_count,
            'isPostLiked' => $likes > 0
        ]);
    }

    public function unlikePost($postSlug)
    {
        $post = $this->post->where('slug', $postSlug)->first();
        $post->likes->where('user_id', Auth::id())->first()->delete();
    }

}
