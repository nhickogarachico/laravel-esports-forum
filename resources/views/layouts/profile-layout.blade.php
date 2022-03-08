@extends('layouts.main')

@section('title', "@yield('title')")

@section('content')
    <div class="row">
        <div class="col-lg-3 mx-auto">
            <x-profile-card :user="$user"></x-profile-card>
            <div class="card mb-2">
                <div class="card-body p-0 text-center">
                    <a href="/u/{{ $user->username }}" class="profile-list-item d-block p-2 {{Route::is('user-profile') ? 'active' : ''}}">Activities</a>
                    <a href="/u/{{ $user->username }}/p" class="profile-list-item d-block p-2 {{Route::is('user-posts') ? 'active' : ''}}">Posts</a>
                    <a href="/u/{{ $user->username }}/c" class="profile-list-item d-block p-2 {{Route::is('user-replies') ? 'active' : ''}}">Replies</a>
                </div>
            </div>
        </div>
        <div class="col">
            @yield('profile-content')
        </div>
    </div>

@endsection
