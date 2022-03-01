@extends('layouts.main')

@section('title', 'New Post')

@section('content')
<div class="row">
    <div class="col-6 mx-auto">
        <a href="/u/{{$username}}">Back</a>
        <h1>New Post</h1>
        <add-post-form :tags="{{$tags}}" :user-id="{{Auth::user()->id}}" username="{{$username}}"></add-post-form>
    </div>
</div>
@endsection
