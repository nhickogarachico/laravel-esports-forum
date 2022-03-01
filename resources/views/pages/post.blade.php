@extends('layouts.main')

@section('title', $post->title . ' | Esports Forum')

@section('content')
    <div class="row">
        <div class="col-11 mx-auto d-flex">
            <div>
                <a href="/u/{{$user->username}}"><img src="{{ $user->avatar ? $user->avatar : '/images/default_profile.png' }}"
                    alt="{{ $user->avatar }} avatar" class="rounded-circle avatar-small" /></a>
            </div>
            <div>
                <h1>{{ $post->title }}</h1>
                <a href="/u/{{$user->username}}">{{ $user->username }}</a>
                <p>posted {{ $post->created_at->diffForHumans() }}</p>
                <p>{{ $post->content }}</p>
                @foreach ($post->tags as $tag)
                    <span class="badge bg-primary">{{ $tag->tag }}</span>
                @endforeach
            </div>
        </div>
    </div>
@endsection
