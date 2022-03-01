<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
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
            
    }
}
