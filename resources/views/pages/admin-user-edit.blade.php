@extends('layouts.main')

@section('title', $user->username . ' | Edit')

@section('content')
    <div class="row">
        <div class="col-6 mx-auto">

            <h1>Edit Profile</h1>
            <form action="/admin/users/{{$user->id}}/edit" method="POST">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <div class="mb-2">
                    <p>Username {{ $user->username }}</p>
                </div>

                <div class="mb-2">
                    <label for="role">Role</label>
                    <select class="form-select" name="role_id" value="{{ $user->role_id }}">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id === $role->id ? 'selected' : '' }}>
                                {{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <a href="/admin/users" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
