<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function showNewPostView($username)
    {
        if(Gate::allows('add-post', $username)) {
            return view('pages.new-post', [
                'username' => $username
            ]);
        } else {
            return back();
        }
        
    }
}
