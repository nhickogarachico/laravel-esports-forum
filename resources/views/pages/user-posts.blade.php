@extends('layouts.profile-layout')

@section('title', $user->username . ' | Posts')

@section('profile-content')
    @if (Auth::check() && Auth::user()->username === $user->username)
        <h3 class="mb-2">My Posts</h3>
    @else
        <h3 class="mb-2">{{ $user->username }}'s Activities</h3>
    @endif

    @if (Auth::check() && Auth::user()->username === $user->username)
        <a href="/u/{{ $user->username }}/p/new" class="btn btn-primary">New Post</a>
    @endif

    @if (count($user->posts) > 0)
        @foreach ($user->posts as $post)
            <div class="card">
                <div class="card-body">
                    <div>
                        <a href="/p/{{ $post->slug }}" class="stretched-link">{{ $post->title }}</a>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle position-relative button-in-stretched-link"  type="button" id="postDropdown{{$post->id}}"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="postDropdown{{$post->id}}">
                                <li><a class="dropdown-item" href="/p/{{$post->slug}}/edit">Edit Post</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Delete Post</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <p>Posted {{ $post->created_at->diffForHumans() }}</p>
                    @foreach ($post->tags as $tag)
                        <span class="badge bg-primary">{{ $tag->tag }}</span>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <div class="card-body text-center">No posts yet</div>
    @endif


@endsection
