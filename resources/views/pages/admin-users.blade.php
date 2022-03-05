@extends('layouts.admin')

@section('admin-content')
    <h1>Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Registered</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->role->role}}</td>
                    <td>{{ $user->created_at->format('Y-m-d')}}</td>
                    <td>
                        <div class="d-flex">
                            <a href="/u/{{$user->username}}/edit" class="btn btn-warning"><i class="fas fa-pencil"></i></a>
                            <a href="/u/{{$user->username}}" class="btn btn-success"><i class="fas fa-external-link"></i></a>
                            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
