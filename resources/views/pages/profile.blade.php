@extends('layouts.profile-layout')

@section('title', $user->username . ' | Profile')

@section('profile-content')
    @if (Auth::check() && Auth::user()->username === $user->username)
        <h3 class="mb-2">My Activities</h3>
    @else
        <h3 class="mb-2">{{ $user->username }}'s Activities</h3>
    @endif

    <div class="card">
        <div class="card-body text-center">No activities yet</div>
    </div>
@endsection
