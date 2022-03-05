@extends('layouts.main')

@section('title', $post->title . ' | Esports Forum')

@section('content')
    <div class="row">
        <div class="col mx-auto">
            <a href="/" class="btn btn-primary">Back</a>
            <div class="d-flex">
                <div>
                    <a href="/u/{{ $post->user->username }}"><img src="{{ $post->user->avatar }}"
                            alt="{{ $post->user->avatar }} avatar" class="rounded-circle avatar-small" /></a>
                </div>
                <div>
                    <h1>{{ $post->title }}</h1>
                    <a href="/u/{{ $post->user->username }}">{{ $post->user->username }}</a>
                    <p>posted {{ $post->created_at->diffForHumans() }}</p>
                    @if ($post->created_at < $post->updated_at)
                        <p>edited {{ $post->updated_at->diffForHumans() }}</p>
                    @endif

                    <p>{{ $post->content }}</p>
                    @foreach ($post->tags as $tag)
                       <a href="/{{$tag->query_tag}}"><span class="badge bg-primary">{{ $tag->tag }}</span></a> 
                    @endforeach
                    <like-button like-route-parameter="{{ $post->slug }}" :is-liked="{{ $post->likes }}" likeable="p" :initial-likes-count="{{$post->likes_count}}"></like-button>
                </div>
            </div>
            @if (Auth::check())
                <div class="mb-3">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <label for="content">Add Comment</label>
                    <form action="/p/{{ $post->slug }}/comment" method="POST">
                        @csrf
                        <textarea name="content" class="form-control"></textarea>
                        <button type="submit" class="btn btn-primary">Comment</button>
                    </form>
                </div>
            @endif
            <div>
                @foreach ($post->comments as $comment)
                    <x-comment-card :comment="$comment"></x-comment-card>
                @endforeach
            </div>
        </div>
    </div>
@endsection
