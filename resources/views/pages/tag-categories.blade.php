@extends('layouts.main')

@section('content')
    <div>
        <div class="row">
            <h1 class="mb-3">{{$tagCategory->category}}</h1>
            <div class="mb-3">
                <a href="/" class="primary-link">Home</a> >
                <a href="/{{$tagCategory->query_string}}" class="primary-link">{{$tagCategory->category}}</a>
            </div>
            <div class="col">
                <div class="card mb-3 border-bottom-0">
                    <div class="card-header p-3">
                        <p class="mb-0">{{$tagCategory->category}} Discussions</p>
                    </div>
                    @foreach ($tags as $tag)
                        <div class="card-body d-flex justify-content-between py-2 px-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div>
                                    <i class="fas fa-gamepad text-primary"></i>
                                </div>
                                <div class="ms-3">
                                    <a href="/{{$tag->tagCategory->query_string}}/{{$tag->query_tag}}" class="primary-link fw-bold fs-5">{{ $tag->tag }}</a>
                                    <p>{{ $tag->flavor }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center home-item-2">
                                <div class="me-5 text-center">
                                    <p class="fs-3">
                                        {{ $tag->getTag($tag->query_tag)->posts_count }}</p>
                                    <p>Posts</p>
                                </div>
                                <div class="link-item d-flex">
                                    @if ($tag->getTag($tag->query_tag)->posts_count > 0)
                                        <div>
                                            <a href="/u/{{ $tag->getTag($tag->query_tag)->posts[0]->user->username }}">
                                                <img src="{{ $tag->getTag($tag->query_tag)->posts[0]->user->avatar }}"
                                                    alt="{{ $tag->getTag($tag->query_tag)->posts[0]->user->username }} avatar"
                                                    class="avatar-xs rounded-circle me-2">
                                            </a>
                                        </div>
                                        <div>
                                            <p><a href="/p/{{ $tag->getTag($tag->query_tag)->posts[0]->slug }}"
                                                    class="primary-link">{{ $tag->getTag($tag->query_tag)->posts[0]->title }}</a>
                                            </p>
                                            <p>by <a
                                                    href="/u/{{ $tag->getTag($tag->query_tag)->posts[0]->user->username }}">{{ $tag->getTag($tag->query_tag)->posts[0]->user->username }}</a>
                                            </p>
                                            <p>{{ $tag->getTag($tag->query_tag)->posts[0]->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
