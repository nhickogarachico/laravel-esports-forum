@extends('layouts.admin')

@section('admin-content')
    <h1>Tags</h1>
  <add-tag-button></add-tag-button>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Tag</th>
                <th scope="col">Query Tag</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{$tag->id}}</td>
                    <td>{{ $tag->tag }}</td>
                    <td>{{ $tag->query_tag}}</td>
                    <td>
                        <div class="d-flex">
                            <button class="btn btn-warning"><i class="fas fa-pencil"></i></button>
                            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
