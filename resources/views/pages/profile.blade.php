@extends('layouts.main')

@section('title', $user->username . ' | Profile')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-2">
                <div class="card-header">
                    <img src="/images/default_profile.png" alt="{{ $user->username }} avatar">
                </div>
                <div class="card-body">
                    <div>
                        <h4>{{ $user->username }}</h4>
                        @if (Auth::check() && Auth::user()->username === $user->username)
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="profileSettingsDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-gear"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileSettingsDropdown">
                                    <li><a class="dropdown-item" href="/u/{{ Auth::user()->username }}">Edit Profile</a>
                                    </li>
                                    <li><a class="dropdown-item" href="/u/{{ Auth::user()->username }}">Account
                                            Settings</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                    <p><i class="fas fa-comment"></i> Posts 20</p>
                    <p><i class="fas fa-comments"></i> Comments 15</p>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Posts</h3>
                    @if (Auth::check() && Auth::user()->username === $user->username)
                        <a href="/u/{{$user->username}}/p/new" class="btn btn-primary">New Post</a>
                    @endif
                </div>
                <div class="card-body text-center">
                    No posts yet
                </div>
            </div>
        </div>
        <div class="col">
            @if (Auth::check() && Auth::user()->username === $user->username)
                <h3 class="mb-2">My Activities</h3>
            @else
                <h3 class="mb-2">{{ $user->username }}'s Activities</h3>
            @endif

            <div class="card">
                <div class="card-body text-center">No activities yet</div>

            </div>
        </div>
    </div>
@endsection
