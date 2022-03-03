<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    protected $post;
    protected $comment;
    public function __construct(Post $post, Comment $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }

    public function commentToPost(StoreCommentRequest $request, $postSlug)
    {
        $post = $this->post->where('slug', $postSlug)->first();

        $this->comment->create(
            array_merge($request->validated(), [
                'user_id' => Auth::id(),
                'post_id' => $post->id
            ])

        );

        return back();
    }
}
