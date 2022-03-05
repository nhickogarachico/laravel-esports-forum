@extends('layouts.admin')

@section('admin-content')
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4><i class="fas fa-users"></i></h4>
                    <p>{{ $users->count() }} Total Members</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4><i class="fas fa-comment"></i></h4>
                    <p>{{ $posts->count() }} Total Posts</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4><i class="fas fa-comments"></i></h4>
                    <p>{{ $comments->count() }} Total Replies</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2>Latest Posts</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">User</th>
                        <th scope="col">Post Date</th>
                        <th scope="col">Tags</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td><a href="/p/{{ $post->slug }}">{{ $post->title }}</a></td>
                            <td>{{ $post->user->username }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                @foreach ($post->tags as $tag)
                                    <span class="badge bg-primary">{{ $tag->tag }}</span>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2>Posts By Tag</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Tag</th>
                        <th scope="col"># of Posts</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tagsPostNumber as $tag)
                        <tr>
                            <td><a href="/{{ $tag->query_tag }}">{{ $tag->tag }}</a></td>
                            <td>{{ $tag->posts_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
