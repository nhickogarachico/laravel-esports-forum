@extends('layouts.profile-layout')

@section('title', $user->username . ' | Profile')

@section('profile-content')
    <div class="bg-primary p-2 activity-container-header">
        @if (Auth::check() && Auth::user()->username === $user->username)
            <h3 class="fs-5 mb-0">My Activities</h3>
        @else
            <h3 class="fs-5 mb-0">{{ $user->username }}'s Activities</h3>
        @endif
    </div>

    @if ($activitiesCount > 0)
    <x-pagination position="Top" :total-items="$activitiesCount" :per-page="$perPage" :page-number="$pageNumber"></x-pagination>
        @foreach ($activities->activitiesPagination($user->id, $pageNumber, $perPage) as $activity)
            <div class="activity-container p-3 border-bottom">
                @switch($activity->activitiable_type)
                    @case('App\Models\Post')
                        <div class="d-flex">
                            <div><a href="/u/{{ $activity->user->username }}">
                                    <img src="{{ $activity->user->avatar }}" alt="{{ $activity->user->username }} avatar"
                                        class="avatar-xs rounded-circle me-2 profile-avatar-xs"></a>
                            </div>
                            <div>
                                <p class="fs-5"><a
                                        href="/p/{{ $activity->activitiable->slug }}">{{ $activity->activitiable->title }}</a>
                                </p>
                                <p><a href="/u/{{ $activity->user->username }}">{{ $activity->user->username }}</a> added a
                                    new post.</p>
                                @foreach ($activity->activitiable->tags as $tag)
                                    <x-tag-badge :tag="$tag"></x-tag-badge>
                                @endforeach
                                <p class="my-3">{{ Str::words($activity->activitiable->content, 50, '...') }}</p>
                                <div class="d-flex">
                                    <p class="text-secondary">{{ $activity->activitiable->created_at->diffForHumans() }}</p>
                                    <p class="text-secondary ms-3">{{ $activity->activitiable->comments->count() }} Replies</p>
                                </div>
                            </div>
                        </div>
                    @break

                    @case('App\Models\Comment')
                        <div class="d-flex">
                            <div><a href="/u/{{ $activity->user->username }}">
                                    <img src="{{ $activity->user->avatar }}" alt="{{ $activity->user->username }} avatar"
                                        class="avatar-xs rounded-circle me-2 profile-avatar-xs"></a>
                            </div>
                            <div>
                                <p class="fs-5"><a
                                        href="/p/{{ $activity->activitiable->post->slug }}/#{{ $activity->activitiable->id }}">{{ $activity->activitiable->post->title }}</a>
                                </p>
                                <p> <a href="/u/{{ $activity->user->username }}">{{ $activity->user->username }} </a> replied
                                    to a
                                    post.</p>
                                @foreach ($activity->activitiable->post->tags as $tag)
                                    <x-tag-badge :tag="$tag"></x-tag-badge>
                                @endforeach
                                <p class="my-3">{{ Str::words($activity->activitiable->content, 50, '...') }}</p>
                                <div class="d-flex">
                                    <p class="text-secondary">{{ $activity->activitiable->created_at->diffForHumans() }}</p>
                                    <p class="text-secondary ms-3"><a href="/p/{{$activity->activitiable->post->slug}}/#{{$activity->activitiable->id}}">{{ $activity->activitiable->replies->count() }}
                                            Replies</a> </p>
                                </div>
                                </p>
                            </div>
                        </div>
                    @case('App\Models\Like')
                        @if ($activity->activitiable->likeable_type === 'App\Models\Post')
                            <div class="d-flex">
                                <div><a href="/u/{{ $activity->user->username }}">
                                        <img src="{{ $activity->user->avatar }}" alt="{{ $activity->user->username }} avatar"
                                            class="avatar-xs rounded-circle me-2 profile-avatar-xs"></a>
                                </div>
                                <div>
                                    <p class="fs-5"><a
                                            href="/p/{{ $activity->activitiable->likeable->slug }}">{{ $activity->activitiable->likeable->title }}</a>
                                    </p>
                                    <p><a href="{{ $activity->user->username }}">{{ $activity->user->username }}</a> liked a
                                        post.</p>

                                    @foreach ($activity->activitiable->likeable->tags as $tag)
                                        <x-tag-badge :tag="$tag"></x-tag-badge>
                                    @endforeach
                                    <p class="text-secondary mt-3">
                                        {{ $activity->activitiable->likeable->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @elseif($activity->activitiable->likeable_type === 'App\Models\Comment')
                            <div class="d-flex">
                                <div><a href="/u/{{ $activity->user->username }}">
                                        <img src="{{ $activity->user->avatar }}" alt="{{ $activity->user->username }} avatar"
                                            class="avatar-xs rounded-circle me-2 profile-avatar-xs"></a>
                                </div>
                                <div>
                                    <p class="fs-5"><a
                                            href="/p/{{ $activity->activitiable->likeable->post->slug }}/#{{ $activity->activitiable->likeable->id }}">{{ $activity->activitiable->likeable->post->title }}</a>
                                    </p>
                                    <p><a href="{{ $activity->user->username }}">{{ $activity->user->username }}</a> liked a
                                        reply.</p>
                                    @foreach ($activity->activitiable->likeable->post->tags as $tag)
                                        <x-tag-badge :tag="$tag"></x-tag-badge>
                                    @endforeach
                                    <p class="text-secondary mt-3">
                                        {{ $activity->activitiable->likeable->created_at->diffForHumans() }}</p>
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endswitch
                </div>
            @endforeach
        @else
            <div class="card">
                <div class="card-body text-center">No activities yet</div>
            </div>
        @endif


    @endsection
