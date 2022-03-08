@extends('layouts.main')

@section('title', $post->title | 'Edit')

@section('content')
<div class="row">
    <div class="col-6 mx-auto">
        <a href="/u/{{$post->user->username}}" class="text-primary">Back</a>
        <h1 class="mt-2">Edit Post</h1>
        <edit-post-form :post="{{$post}}" :tags="{{$tags}}" :post-tags="{{$postTags}}"></edit-post-form>    
    </div>
</div>
@endsection
