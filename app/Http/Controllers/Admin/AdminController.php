<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeletePostAdminRequest;
use App\Http\Requests\Admin\DeleteTagRequest;
use App\Http\Requests\Admin\DeleteUserRequest;
use App\Http\Requests\Admin\EditTagRequest;
use App\Http\Requests\Admin\EditUserRoleRequest;
use App\Http\Requests\Admin\StoreTagRequest;
use App\Http\Requests\Admin\ViewPasswordRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Role;
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
    protected $role;

    public function __construct(User $user, Post $post, Comment $comment, Tag $tag, Role $role)
    {
        $this->user = $user;
        $this->post = $post;
        $this->comment = $comment;
        $this->tag = $tag;
        $this->role = $role;
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

    public function showEditUserView($userId)
    {
        $user = $this->user->where('id', $userId)->first();
        if (Gate::allows('access-admin', Auth::user())) {

            return view('pages.admin-user-edit', [
                'user' => $user,
                'roles' => $this->role->all()
            ]);
        } else {
            return abort(404);
        }
    }

    public function editUserRole(EditUserRoleRequest $request, $userId)
    {
        $user = $this->user->where('id', $userId)->first();
        if (Gate::allows('access-admin', Auth::user())) {
            $user->role_id = $request->validated()['role_id'];
            $user->save();
            return redirect('/admin/users');
        } else {
            return abort(404);
        }
    }

    public function showDeleteUserView($userId)
    {
        $user = $this->user->where('id', $userId)->first();
        if (Gate::allows('access-admin', Auth::user())) {

            return view('pages.admin-user-delete', [
                'user' => $user,
                'roles' => $this->role->all()
            ]);
        } else {
            return abort(404);
        }
    }

    public function deleteUser(DeleteUserRequest $request, $userId)
    {
        $user = $this->user->where('id', $userId)->first();

        if (Gate::allows('access-admin', Auth::user())) {

            if (Hash::check($request->validated()['password'], Auth::user()->password)) {
                $user->delete();
            } else {
                return back()->withErrors([
                    'error' => 'Wrong password'
                ]);
            }
        } else {
            return abort(404);
        }
    }

    public function editTag(EditTagRequest $request, $tagId)
    {
        $tag = $this->tag->where('id', $tagId)->first();
        $tag->tag = $request->validated()['tag'];
        $tag->query_tag = $request->validated()['query_tag'];
        $tag->save();
        return response()->json([
            'message' => 'Edited tag'
        ]);
    }

    public function deleteTag(DeleteTagRequest $request, $tagId)
    {
        $tag = $this->tag->where('id', $tagId)->first();
        if (Hash::check($request->validated()['password'], Auth::user()->password)) {
            $tag->delete();
        } else {
            return response()->json([
                'message' => 'Wrong password'
            ], 403);
        }
    }

    public function deletePostAdmin(DeletePostAdminRequest $request, $postSlug)
    {
        $post = $this->post->where('slug', $postSlug)->first();
        if (Hash::check($request->validated()['password'], Auth::user()->password)) {
            $post->delete();
        } else {
            return response()->json([
                'message' => 'Wrong password'
            ], 403);
        }
    }
}
