@extends('layouts.main')

@section('content')
    <div>
        <div class="row">
            <h1 class="mb-1">{{ $tag->tag }}</h1>
            <p class="mb-3">{{ $tag->flavor }}</p>
            <div class="mb-3">
                <a href="/" class="primary-link">Home</a> >
                <a href="/{{ $tag->tagCategory->query_string }}" class="primary-link">{{ $tag->tagCategory->category }}
                </a> >
                <a href="/{{ $tag->tagCategory->query_string }}/{{ $tag->query_tag }}"
                    class="primary-link">{{ $tag->tag }}</a>
            </div>
            <div class="col">
                <div class="card mb-3 border-bottom-0">
                    <div class="card-header p-3">
                        <p class="mb-0">Posts</p>
                    </div>
                    @if ($tag->posts->count() > 0)
                        <x-pagination position="Top" :total-items="$tag->posts->count()" :per-page="$perPage" :page-number="$pageNumber">
                        </x-pagination>
                        @foreach ($tag->postsPagination($pageNumber, $perPage) as $post)
                            <div class="card-body d-flex justify-content-between py-2 px-3 border-bottom">
                                <div>
                                    <p><a href="/p/{{ $post->slug }}" class="primary-link fs-5">{{ $post->title }}</a>
                                    </p>
                                    @foreach ($post->tags as $tag)
                                        <x-tag-badge :tag="$tag"></x-tag-badge>
                                    @endforeach
                                    <p>by <a href="/u/{{ $post->user->username }}">{{ $post->user->username }}</a>,
                                        {{ $post->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="d-flex align-items-center home-item-2">
                                    <div class="me-5 text-end">
                                        <p>{{ $post->likes->count() }} Likes</p>
                                        <p>{{ $post->comments->count() }} Replies</p>
                                    </div>
                                    <div class="link-item d-flex">
                                        @if ($post->comments->count() > 0)
                                            <div>
                                                <a href="/u/{{ $post->latestComment()->user->username }}">
                                                    <img src="{{ $post->latestComment()->user->avatar }}"
                                                        alt="{{ $post->latestComment()->user->username }} avatar"
                                                        class="avatar-xs rounded-circle me-2">
                                                </a>
                                            </div>
                                            <div>
                                                <p><a
                                                        href="/u/{{ $post->latestComment()->user->username }}">{{ $post->latestComment()->user->username }}</a>
                                                </p>
                                                <p>{{ $post->latestComment()->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        @else
                                            <div>
                                                <a href="/u/{{ $post->user->username }}">
                                                    <img src="{{ $post->user->avatar }}"
                                                        alt="{{ $post->user->username }} avatar"
                                                        class="avatar-xs rounded-circle me-2">
                                                </a>
                                            </div>
                                            <div>
                                                <p><a
                                                        href="/u/{{ $post->user->username }}">{{ $post->user->username }}</a>
                                                </p>
                                                <p>{{ $post->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <x-pagination position="Bottom" :total-items="$tag->posts->count()" :per-page="$perPage" :page-number="$pageNumber">
                        </x-pagination>
                    @else
                        <div class="text-center p-5 border-bottom">No posts yet</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
