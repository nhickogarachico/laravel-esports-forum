@extends('layouts.main')

@section('title', 'New Post')

@section('content')
<div class="row">
    <div class="col-6 mx-auto">

        <h1>Edit Post</h1>
        <edit-post-form :post="{{$post}}" :tags="{{$tags}}" :post-tags="{{$postTags}}"></edit-post-form>    
    </div>
</div>
@endsection
