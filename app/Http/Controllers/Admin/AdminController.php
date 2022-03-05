<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTagRequest;
use App\Http\Requests\Admin\ViewPasswordRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $user;
    protected $post;
    protected $comment;
    protected $tag;
    protected $like;

    public function __construct(User $user, Post $post, Comment $comment, Tag $tag, Like $like)
    {
        $this->user = $user;
        $this->post = $post;
        $this->comment = $comment;
        $this->tag = $tag;
        $this->like = $like;
    }
    public function showAdminHomeView()
    {
        if (Gate::allows('access-admin', Auth::user())) {

            return view('pages.admin-dashboard', [
                'users' => $this->user->all(),
                'posts' => $this->post->orderBy('created_at', 'DESC')->get(),
                'comments' => $this->comment->all(),
                'tagsPostNumber' => $this->tag->withCount('posts')->orderBy('posts_count', 'DESC')->get(),
            ]);
        } else {
            return abort(404);
        }
    }

    public function showAdminUserView()
    {
        if (Gate::allows('access-admin', Auth::user())) {

            return view('pages.admin-users', [
                'users' => $this->user->all(),
            ]);
        } else {
            return abort(404);
        }
    }

    public function showAdminTagsView()
    {
        if (Gate::allows('access-admin', Auth::user())) {

            return view('pages.admin-tags', [
                'tags' => $this->tag->all(),
            ]);
        } else {
            return abort(404);
        }
    }

    public function addTag(StoreTagRequest $request)
    {
        $this->tag->create($request->validated());

        return response()->json([
            'message' => 'Added tag'
        ]);
    }

    public function showAdminPostsView()
    {
        if (Gate::allows('access-admin', Auth::user())) {

            return view('pages.admin-posts', [
                'posts' => $this->post->orderBy('created_at', 'DESC')->get(),
            ]);
        } else {
            return abort(404);
        }   
    }

    public function showEditUserView()
    {
        if (Gate::allows('access-admin', Auth::user())) {

            return view('pages.admin-edit-user', [
                'posts' => $this->post->orderBy('created_at', 'DESC')->get(),
            ]);
        } else {
            return abort(404);
        } 
    }
}
