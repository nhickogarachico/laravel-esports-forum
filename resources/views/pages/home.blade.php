@extends('layouts.main')

@section('content')
    <div>
        <div class="row">
            <h1 class="mb-3">Welcome to Esports Forum!</h1>
            <div class="mb-3">
                <a href="/" class="primary-link">Home</a>
            </div>
            <div class="col">
                <div class="card mb-3 border-bottom-0">
                    <div class="card-header p-3">
                        <p class="mb-0">General Discussions</p>
                    </div>
                    @foreach ($tag->tagsByCategory(1, 5) as $tag)
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
                <div class="card mb-3 border-bottom-0">
                    <div class="card-header p-3">
                        <p class="mb-0">Esports Discussions</p>
                    </div>
                    @foreach ($tag->tagsByCategory(2, 5) as $tag)
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
                    @if ($tag->tagsByCategoryCount(2) > 5)
                        <div class="card-body d-flex justify-content-between py-2 px-3 border-bottom">
                            <a href="/{{$tagCategory->tagCategoryById(2)->query_string}}" class="primary-link">More Esports >></a>
                        </div>
                    @endif
                </div>
                <div class="card mb-3 border-bottom-0">
                    <div class="card-header p-3">
                        <p class="mb-0">Teams Discussions</p>
                    </div>
                    @foreach ($tag->tagsByCategory(3, 5) as $tag)
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
                    @if ($tag->tagsByCategoryCount(3) > 5)
                        <div class="card-body d-flex justify-content-between py-2 px-3 border-bottom">
                            <a href="/{{$tagCategory->tagCategoryById(3)->query_string}}" class="primary-link">More Teams >></a>
                        </div>
                    @endif
                </div>
                <div class="card mb-3">
                    <div class="card-header p-3">
                        <p class="mb-0">Forum Statistics</p>
                    </div>
                    <div class="card-body px-5">
                        <div class="row">
                            <div class="col-sm text-center mb-2">
                                <p class="fs-5 fw-bold">{{ $users->count() }}</p>
                                <p>Total Members</p>
                            </div>
                            <div class="col-sm text-center mb-2">
                                <p class="fs-5 fw-bold">{{ $posts->count() }}</p>
                                <p>Total Posts</p>
                            </div>
                            <div class="col-sm text-center mb-2">
                                @if ($users->count() > 0)
                                    <p class="fs-5 fw-bold"><a href="/u/{{ $users[0]->username }}"
                                            class="primary-link">{{ $users[0]->username }}</a> </p>
                                @else
                                    <p class="fs-5 fw-bold">No new member</p>
                                @endif
                                <p>Newest Member</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <a href="/" class="primary-link">Home</a>
        </div>
    </div>
@endsection
