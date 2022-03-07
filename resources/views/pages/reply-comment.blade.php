@extends('layouts.main')

@section('title', 'Reply')

@section('content')
    <a href="/p/{{ $comment->post->slug }}" class="mb-3 d-inline-block">Back</a>
    <p>Reply to {{ $comment->user->username === Auth::user()->username ? 'your' : $comment->user->usernam . '\'s' }} comment: </p>
    <div class="p-3">{!! nl2br(e($comment->content)) !!}</div>

    <div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <form action="/p/{{ $comment->post->slug }}/comment/{{$comment->id}}" method="POST">
            @csrf
            <textarea name="content" class="form-control mb-2" placeholder="Write your reply..."></textarea>
            <button type="submit" class="btn btn-primary">Reply</button>
        </form>
    </div>
@endsection
