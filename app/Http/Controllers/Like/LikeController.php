<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    protected $post;
    protected $comment;
    public function __construct(Post $post, Comment $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }

    public function likePost($postSlug)
    {

        $like = new Like(["user_id" => Auth::id()]);

        $post = $this->post->where('slug', $postSlug)->first();
        $post->likes()->save($like);

        $activity = new Activity(["user_id" => Auth::id()]);
        $like->activities()->save($activity);
    }

    public function getPostLikeData($postSlug)
    {
        $post = $this->post->where('slug', $postSlug)->withCount('likes')->first();
        $likes = $post->likes->where('user_id', Auth::id())->count();

        return response()->json([
            'likesCount' => $post->likes_count,
            'isLiked' => $likes > 0
        ]);
    }

    public function getCommentLikeData($commentId)
    {
        $comment = $this->comment->where('id', $commentId)->withCount('likes')->first();
        $likes = $comment->likes->where('user_id', Auth::id())->count();

        return response()->json([
            'likesCount' => $comment->likes_count,
            'isLiked' => $likes > 0
        ]);
    }
    public function unlikePost($postSlug)
    {
        $post = $this->post->where('slug', $postSlug)->first();
        $post->likes->where('user_id', Auth::id())->first()->delete();
    }

    public function likeComment($commentId)
    {
        $like = new Like(["user_id" => Auth::id()]);

        $comment = $this->comment->where('id', $commentId)->first();
        $comment->likes()->save($like);

        $activity = new Activity(["user_id" => Auth::id()]);
        $like->activities()->save($activity);
    }

    public function unlikeComment($commentId)
    {
        $comment = $this->comment->where('id', $commentId)->first();
        $comment->likes->where('user_id', Auth::id())->first()->delete();
    }
}
