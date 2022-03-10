@extends('layouts.main')

@section('title', $post->title . ' | Esports Forum')

@section('content')
    <div class="row">
        <div class="col mx-auto">
            <div class="mb-2">
                <a href="/" class="primary-link">Home</a>
                @foreach ($post->tags as $tag)
                    <div>
                        ><a href="/{{ $tag->tagCategory->query_string }}" class="primary-link">
                            {{ $tag->tagCategory->category }}
                        </a>>
                        <a href="/{{ $tag->tagCategory->query_string }}/{{ $tag->query_tag }}"
                            class="primary-link">{{ $tag->tag }}</a>
                    </div>
                @endforeach
            </div>
            <div class="mb-2">
                <h1 class="mb-0">{{ $post->title }}</h1>
                <div class="d-flex align-items-center">
                    <p><a href="/u/{{ $post->user->username }}" class="me-2">{{ $post->user->username }}</a>
                    </p>
                    <p>{{ $post->created_at->diffForHumans() }}</p>
                </div>
                <div>
                    @foreach ($post->tags as $tag)
                        <x-tag-badge :tag="$tag"></x-tag-badge>
                    @endforeach
                </div>
            </div>

            @if ($post->comments->count() > 0)
                <x-pagination position="Top" :total-items="$post->comments->count()" :per-page="$perPage"
                    :page-number="$pageNumber">
                </x-pagination>
            @endif

            @if ($pageNumber == 1)
                <x-post-container :post="$post"></x-post-container>
            @endif

            <div>
                @foreach ($post->commentsPagination($pageNumber, $perPage) as $comment)
                    <div id="{{ $comment->id }}">
                        <x-comment-card :comment="$comment"></x-comment-card>
                    </div>
                @endforeach
            </div>

            @if ($post->comments->count() > 0)
                <x-pagination position="Top" :total-items="$post->comments->count()" :per-page="$perPage"
                    :page-number="$pageNumber">
                </x-pagination>
            @endif

            @if (Auth::check())
                <div class="my-3">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <p class="mb-2">Replying as {{ Auth::user()->username }}</p>
                    <form action="/p/{{ $post->slug }}/comment" method="POST">
                        @csrf
                        <textarea name="content" class="form-control mb-2" placeholder="Write your reply..."></textarea>
                        <button type="submit" class="btn btn-primary">Comment</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
