@extends('layouts.main')

@section('title', 'New Post')

@section('content')
<div class="row">
    <div class="col-6 mx-auto">
        <a href="/u/{{$username}}">Back</a>
        <h1>New Post</h1>
        <form action="/login" method="POST">
            @csrf
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="mb-2">
                <label for="title">Title</label>
                <input id="title" type="text" class="form-control" name="title"
                    value="{{ old('title') }}" />
            </div>
            <div class="mb-2">
                <textarea name="content" class="form-control" placeholder="Share your thoughts."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post</button>
        </form>
    </div>
</div>
@endsection
