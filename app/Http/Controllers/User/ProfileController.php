<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditProfileRequest;
use App\Models\Activity;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{

    protected $user;
    protected $activity;
    protected $role;

    public function __construct(User $user, Activity $activity, Role $role)
    {
        $this->user = $user;
        $this->activity = $activity;
        $this->role = $role;
    }

    public function showProfileView(Request $request, $username)
    {
        $user = $this->user->fetchUserByUsername($username);
        if ($user) {
            return view('pages.profile', [
                'user' => $user,
                'perPage' => 10,
                'pageNumber' => $request->query('pageNumber') ? $request->query('pageNumber') : 1,
                'activities' => $this->activity,
                'activitiesCount' => $this->activity->where('user_id', $user->id)->orderBy('created_at', 'DESC')->count()
            ]);
        }


        return abort(404);
    }

    public function showEditProfileView($username)
    {
        $user = $this->user->fetchUserByUsername($username);

        if ($user && Gate::allows('edit-profile', $user) || Gate::allows('access-admin', Auth::user())) {
            return view('pages.edit-profile', [
                'user' => $user,

            ]);
        } else {
            return abort(401, "You are not authorized to do this action");
        }

        return abort(404);
    }

    public function editUserProfile(EditProfileRequest $request, $username)
    {
        $user = $this->user->fetchUserByUsername($username);

        if (!$user) {
            return abort(404);
        }

        if (Gate::allows('edit-profile', $user)) {
            $user->username = $request->validated()['username'];

            // Upload image
            if ($request->file('avatar')) {
                $avatarDirectory = '/images/database/' . $user->id . '/profiles';

                if (!File::exists($avatarDirectory)) {
                    File::makeDirectory($avatarDirectory, 0777, true);
                }

                //image name
                $avatarName = "profile-" . $user->id . '.' . $request->file('avatar')->extension();
                $avatarPath = $avatarDirectory . "/" . $avatarName;

                $request->file('avatar')->move(public_path($avatarDirectory), $avatarName);
                $user->avatar = $avatarPath;
            }

            $user->save();
            return redirect()->route('user-profile', $user->username);
        } else {
            return response()->json([
                'message' => 'You are not authorized to do this action'
            ], 401);
        }
    }

    public function showUserCommentsView(Request $request, $username)
    {
        $user = $this->user->fetchUserByUsername($username);
        if($user)
        {
            return view('pages.user-replies', [
                'user' => $user,
                'perPage' => 10,
                'pageNumber' => $request->query('pageNumber') ? $request->query('pageNumber') : 1,
            ]);
        } else {
            return abort(404);
        }
        
    }
    
}
