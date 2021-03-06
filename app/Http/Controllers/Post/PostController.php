<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\EditPostRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Models\Activity;
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
        if (Gate::allows('add-post', $username)) {
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
        foreach ($request->validated()['tags'] as $tag) {
            $post->tags()->attach($tag["id"]);
        }
        $activity = new Activity(["user_id" => Auth::id()]);
        $post->activities()->save($activity);

        return response()->json([
            'slug' => $post->slug
        ]);
    }

    public function showPostPageView(Request $request, $postSlug)
    {
        $post = $this->post->where('slug', $postSlug)->withCount('likes')->first();

        if ($post) {
            return view('pages.post', [
                "post" => $post,
                'perPage' => 10,
                'pageNumber' => $request->query('pageNumber') ? $request->query('pageNumber') : 1,
                "user" => $post->user
            ]);
        } else {
            abort(404);
        }
    }

    public function showUserPostsView(Request $request, $username)
    {
        $user = $this->user->fetchUserByUsername($username);
        return view('pages.user-posts', [
            'user' => $user,
            'perPage' => 10,
            'pageNumber' => $request->query('pageNumber') ? $request->query('pageNumber') : 1,
        ]);
    }

    public function showEditPostView($postSlug)
    {
        $post = $this->post->where('slug', $postSlug)->first();

        if ($post) {
            if (Gate::allows('edit-post', $post)) {
                $payload = [
                    'post' => $post,
                    'tags' => Tag::orderBy('tag')->get(),
                    'postTags' => $post->tags
                ];

                return view('pages.edit-post', $payload);
            } else {
                return back();
            }
        } else {
            abort(404);
        }
    }
    public function editPost(EditPostRequest $request, $postSlug)
    {
        $post = $this->post->where('slug', $postSlug)->first();
        $post->content = $request->validated()['content'];
        $tagsId = array_column($request->validated()['tags'], 'id');
        $post->tags()->sync($tagsId);
        $post->save();
    }

    public function deletePost(DeletePostRequest $request, $postSlug)
    {

        $post = $this->post->where('slug', $postSlug)->first();

        if ($request->validated()['usernameConfirmation'] === $post->user->username) {
    
            $post->delete();
        } else {
            return response()->json([
                "message" => 'You typed the wrong username'
            ], 403);
        }
    }
}
