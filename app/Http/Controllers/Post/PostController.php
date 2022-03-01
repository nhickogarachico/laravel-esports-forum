<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    protected $post;
    protected $user;

    public function __construct(Post $post, User $user)
    {   
        $this->post = $post;
        $this->user = $user;
    }

    public function showNewPostView($username)
    {
        if(Gate::allows('add-post', $username)) {
            return view('pages.new-post', [
                'username' => $username,
                'tags' => Tag::orderBy('tag')->get()
            ]);
        } else {
            return back();
        }
        
    }

    public function addPost(StorePostRequest $request)
    {
        $post = $this->post->create($request->validated());
        foreach($request->validated()['tags'] as $tag)
        {
            $post->tags()->attach($tag["id"]);
        }

        return response()->json([
            'slug' => $post->slug
        ]);
    }

    public function showPostPageView($postSlug)
    {
        $post = $this->post->where('slug', $postSlug)->first();

        if($post)
        {
            return view('pages.post',[
                "post" => $post,
                "user" => $post->user
            ]);
        } else {
            abort(404);
        }
    }

    public function showUserPostsView($username)
    {
        $user = $this->user->fetchUserByUsername($username);
        return view('pages.user-posts', [
            'user' => $user,
        ]);
    }
}
