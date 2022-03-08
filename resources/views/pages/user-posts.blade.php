@extends('layouts.profile-layout')

@section('title', $user->username . ' | Posts')

@section('profile-content')
    <div class="bg-primary p-2 activity-container-header d-flex align-items-center">
        @if (Auth::check() && Auth::user()->username === $user->username)
            <h3 class="fs-5 mb-0">My Posts</h3>
        @else
            <h3 class="fs-5 mb-0">{{ $user->username }}'s Posts</h3>
        @endif

        @if (Auth::check() && Auth::user()->username === $user->username)
            <a href="/u/{{ $user->username }}/p/new" class="btn btn-primary ms-1"><i class="fas fa-plus"></i></a>
        @endif
    </div>

    @if ($user->posts->count() > 0)
        @foreach ($user->posts as $post)
            <div class="activity-container p-3 border-bottom">
                <div class="d-flex">
                    <div><a href="/u/{{ $post->user->username }}">
                            <img src="{{ $post->user->avatar }}" alt="{{ $post->user->username }} avatar"
                                class="avatar-xs rounded-circle me-2 profile-avatar-xs"></a>
                    </div>
                    <div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="/p/{{ $post->slug }}" class="fs-5">{{ $post->title }}</a>
                            @if (Auth::check() && Gate::allows('edit-post', $post))
                                <post-settings-dropdown :post="{{ $post }}"></post-settings-dropdown>
                            @endif
                        </div>
                        <p>Posted {{ $post->created_at->diffForHumans() }}</p>

                        @foreach ($post->tags as $tag)
                            <x-tag-badge :tag="$tag"></x-tag-badge>
                        @endforeach
                        <p class="my-3">{{ Str::words($post->content, 50, '...') }}</p>
                        <div class="d-flex">
                            <p class="text-secondary">{{ $post->created_at->diffForHumans() }}</p>
                            <p class="text-secondary mx-2">{{ $post->likes->count() }} Likes</p>
                            <p class="text-secondary">{{ $post->comments->count() }} Replies</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="card-body text-center">No posts yet</div>
    @endif


@endsection
