@extends('layouts.admin')

@section('admin-content')
    <h1>Posts</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">User</th>
                <th scope="col">Tags</th>
                <th scope="col">Post Data</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->username }}</td>
                    <td>
                        @foreach ($post->tags as $tag)
                            <a href="/{{ $tag->query_tag }}"><span class="badge bg-primary">{{ $tag->tag }}</span></a>
                        @endforeach
                    </td>
                    <td>{{ $post->created_at->format('Y-m-d') }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="/p/{{ $post->slug }}" class="btn btn-success"><i class="fas fa-external-link"></i></a>
                           <delete-post-button :post="{{$post}}"></delete-post-button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
