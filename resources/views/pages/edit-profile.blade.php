@extends('layouts.main')

@section('title', $user->username . ' | Edit')

@section('content')
    <div class="row">
        <div class="col-6 mx-auto">

            <h1>Edit Profile</h1>
            <form action="/u/{{ $user->username }}/edit" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <div>
                    <img src="{{ $user->avatar }}" alt="{{ $user->username }} avatar" class="avatar-profile">
                    <input type="file" class="form-control" name="avatar" />
                </div>

                <div class="mb-2">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username"
                        value="{{ old('username', $user->username) }}" />
                </div>
                <div>
                    <a href="/u/{{$user->username}}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
