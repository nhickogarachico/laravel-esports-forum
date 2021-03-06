<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('add-post', function(User $user, String $usernameRoute )
        {
            return $user->username === $usernameRoute;
        });

        Gate::define('edit-post', function(User $user, Post $post)
        {
            return $post->user->id === $user->id;
        });

        Gate::define('edit-profile', function(User $currentUser, User $profileUser) {
            return $profileUser->id === $currentUser->id;
        });

        Gate::define('access-admin', function(User $user)
        {
            return $user->role_id === 2;
        });

    }
}
