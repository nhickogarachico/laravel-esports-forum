@extends('layouts.profile-layout')

@section('title', $user->username . ' | Profile')

@section('profile-content')
    @if (Auth::check() && Auth::user()->username === $user->username)
        <h3 class="mb-2">My Activities</h3>
    @else
        <h3 class="mb-2">{{ $user->username }}'s Activities</h3>
    @endif


    @if ($activities->count() > 0)
        @foreach ($activities as $activity)
            <div class="card mb-3">
                <div class="card-body">
                    @switch($activity->activitiable_type)
                        @case('App\Models\Post')
                            <p>{{ $activity->user->username }} added a new post.</p>
                            <p><a href="/p/{{ $activity->activitiable->slug }}">{{ $activity->activitiable->title }}</a>
                            </p>
                            @foreach ($activity->activitiable->tags as $tag)
                                <span class="badge bg-primary">{{ $tag->tag }}</span>
                            @endforeach
                            <p>{{ $activity->activitiable->content }}</p>
                            <p>{{ $activity->activitiable->created_at->diffForHumans() }}</p>
                        @break

                        @case('App\Models\Comment')
                            <p>{{ $activity->user->username }} replied to a post.</p>
                            <p><a
                                    href="/p/{{ $activity->activitiable->post->slug }}/#{{ $activity->activitiable->id }}">{{ $activity->activitiable->post->title }}</a>
                            </p>
                            @foreach ($activity->activitiable->post->tags as $tag)
                                <span class="badge bg-primary">{{ $tag->tag }}</span>
                            @endforeach
                            <p>{{ $activity->activitiable->content }}</p>
                            <p>{{ $activity->activitiable->created_at->diffForHumans() }}</p>
                        @case('App\Models\Like')
                            @if ($activity->activitiable->likeable_type === 'App\Models\Post')
                                <p>{{ $activity->user->username }} liked a post.</p>
                                <p><a
                                        href="/p/{{ $activity->activitiable->likeable->slug }}">{{ $activity->activitiable->likeable->title }}</a>
                                </p>
                                @foreach ($activity->activitiable->likeable->tags as $tag)
                                    <span class="badge bg-primary">{{ $tag->tag }}</span>
                                @endforeach
                                <p>{{ $activity->activitiable->likeable->content }}</p>
                                <p>{{ $activity->activitiable->likeable->created_at->diffForHumans() }}</p>
                            @elseif($activity->activitiable->likeable_type === 'App\Models\Comment')
                                <p>{{ $activity->user->username }} liked a reply.</p>
                                <p><a
                                        href="/p/{{ $activity->activitiable->likeable->post->slug }}/#{{$activity->activitiable->likeable->id}}">{{ $activity->activitiable->likeable->post->title }}</a>
                                </p>
                                @foreach ($activity->activitiable->likeable->post->tags as $tag)
                                    <span class="badge bg-primary">{{ $tag->tag }}</span>
                                @endforeach
                                <p>{{ $activity->activitiable->likeable->content }}</p>
                                <p>{{ $activity->activitiable->likeable->created_at->diffForHumans() }}</p>
                            @endif
                        @endswitch
                    </div>
                </div>
            @endforeach
        @else
            <div class="card">
                <div class="card-body text-center">No activities yet</div>
            </div>
        @endif


    @endsection
