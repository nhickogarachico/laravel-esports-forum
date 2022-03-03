<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Activity;
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

    public function comment(StoreCommentRequest $request, $postSlug, $commentId = null)
    {
        $post = $this->post->where('slug', $postSlug)->first();

        $comment = $this->comment->create(
            array_merge($request->validated(), [
                'user_id' => Auth::id(),
                'post_id' => $post->id,
                'parent_id' => $commentId
            ])

        );

        $activity = new Activity(["user_id" => Auth::id()]);
        $comment->activities()->save($activity);

        return redirect("/p/$postSlug");
    }

    public function showCommentReplyView($commentId)
    {
        $comment = $this->comment->where('id', $commentId)->first();
        return view('pages.reply-comment',[
            'comment' => $comment
        ]);
    }

}
