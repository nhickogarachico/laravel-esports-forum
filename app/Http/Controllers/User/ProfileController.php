<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function showProfileView($username)
    {
        $user = $this->user->fetchUserByUsername($username);
        if ($user) {
            return view('pages.profile', [
                'user' => $user
            ]);
        }

        return abort(404);
    }
}
