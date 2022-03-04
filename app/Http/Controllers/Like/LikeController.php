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
    protected $activity;
    public function __construct(Post $post, Comment $comment, Activity $activity)
    {
        $this->post = $post;
        $this->comment = $comment;
        $this->activity = $activity;
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
        $like = $post->likes->where('user_id', Auth::id())->first();
        $like->delete();
        $this->activity
            ->where('user_id', Auth::id())
            ->where('activitiable_type', 'App\Models\Like')
            ->where('activitiable_id', $like->id)
            ->first()
            ->delete();
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
        $like = $comment->likes->where('user_id', Auth::id())->first();
        $like->delete();
        
        $this->activity
            ->where('user_id', Auth::id())
            ->where('activitiable_type', 'App\Models\Like')
            ->where('activitiable_id', $like->id)
            ->first()
            ->delete();
    }
}
