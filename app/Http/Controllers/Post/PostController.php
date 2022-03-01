<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    protected $post;

    public function __construct(Post $post)
    {   
        $this->post = $post;
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
    }
}
