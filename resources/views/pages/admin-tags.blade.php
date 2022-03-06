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
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->tag }}</td>
                    <td>{{ $tag->query_tag }}</td>
                    <td>
                        <div class="d-flex">
                            <edit-tag-button :tag="{{ $tag }}"></edit-tag-button>
                            <delete-tag-button :tag="{{ $tag }}"></delete-tag-button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
