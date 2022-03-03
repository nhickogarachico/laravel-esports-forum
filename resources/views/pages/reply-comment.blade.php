@extends('layouts.main')

@section('title', 'Reply')

@section('content')
    <a href="/p/{{ $comment->post->slug }}">Back</a>
    <p>Reply to {{ $comment->user->username }}'s comment</p>
    <div>{{ $comment->content }}</div>

    <div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <label for="content">Reply</label>
        <form action="/p/{{ $comment->post->slug }}/comment/{{$comment->id}}" method="POST">
            @csrf
            <textarea name="content" class="form-control"></textarea>
            <button type="submit" class="btn btn-primary">Reply</button>
        </form>
    </div>
@endsection
