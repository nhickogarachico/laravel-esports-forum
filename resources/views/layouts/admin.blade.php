@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/admin" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/users" class="nav-link">Users</a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/tags" class="nav-link">Tags</a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/posts" class="nav-link">Posts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            @yield('admin-content')
        </div>
    </div>
@endsection