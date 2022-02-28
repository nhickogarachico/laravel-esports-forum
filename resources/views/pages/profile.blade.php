@extends('layouts.main')

@section('title', $user->username . ' | Profile')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
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
                    @if (Auth::check() && Auth::user()->username === $user->username)
                    <a href="#" class="btn btn-primary">New Post</a>
                    @endif
                    
                </div>

            </div>

        </div>
        <div class="col">
            <h3>{{$user->username}}'s Activity</h3>
            <div class="card">
                
            </div>
        </div>
    </div>
@endsection
