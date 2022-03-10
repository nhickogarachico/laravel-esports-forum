@extends('layouts.profile-layout')

@section('title', $user->username . ' | Replies')

@section('profile-content')
    <div class="bg-primary p-2 activity-container-header d-flex align-items-center">
        @if (Auth::check() && Auth::user()->username === $user->username)
            <h3 class="fs-5 mb-0">My Replies</h3>
        @else
            <h3 class="fs-5 mb-0">{{ $user->username }}'s Replies</h3>
        @endif
    </div>

    @if ($user->comments->count() > 0)
        <x-pagination position="Top" :total-items="$user->comments->count()" :per-page="$perPage" :page-number="$pageNumber">
        </x-pagination>
        @foreach ($user->commentsPagination($pageNumber, $perPage) as $comment)
            <div class="activity-container p-3 border-bottom">
                <div class="d-flex">
                    <div><a href="/u/{{ $comment->user->username }}">
                            <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->username }} avatar"
                                class="avatar-xs rounded-circle me-2 profile-avatar-xs"></a>
                    </div>
                    <div>
                        <p class="fs-5"><a href="/p/{{ $comment->post->slug }}">{{ $comment->post->title }}</a>
                        </p>
                        <p>Posted {{ $comment->created_at->diffForHumans() }}</p>
                        @foreach ($comment->post->tags as $tag)
                            <x-tag-badge :tag="$tag"></x-tag-badge>
                        @endforeach
                        @if ($comment->parent_id)
                            <div class="mb-3 mt-2">
                                <p class="pe-3 py-1">Replied to <a
                                        href="/u/{{ $comment->parentComment->user->username }}">{{ $comment->parentComment->user->username }}</a>
                                </p>
                                <div class="post-reply p-3">
                                    <p>{{ Str::words($comment->parentComment->content, 50, '...') }}</p>
                                </div>
                            </div>
                        @endif
                        <p class="my-3">{{ Str::words($comment->content, 50, '...') }}</p>
                        <div class="d-flex">
                            <p class="text-secondary">{{ $comment->created_at->diffForHumans() }}</p>
                            <p class="text-secondary ms-3"><a
                                    href="/p/{{ $comment->post->slug }}/#{{ $comment->id }}">{{ $comment->replies->count() }}
                                    Replies</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="card">
            <div class="card-body text-center">No posts yet</div>
        </div>
    @endif


@endsection
