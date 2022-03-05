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
                        @if (Auth::check() && Gate::allows('edit-post', $post))
                            <post-settings-dropdown :post="{{ $post }}"></post-settings-dropdown>
                        @endif
                    </div>
                    <p>Posted {{ $post->created_at->diffForHumans() }}</p>

                    @foreach ($post->tags as $tag)
                        <a href="/{{ $tag->query_tag }}"><span class="badge bg-primary">{{ $tag->tag }}</span></a>
                    @endforeach
                    <div>
                        <like-button :post="{{ $post }}" :is-liked="{{ $post->likes }}"></like-button>
                        <p>{{ $post->comments->count() > 0 ? $post->comments->count() . ' replies' : '' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="card-body text-center">No posts yet</div>
    @endif


@endsection
