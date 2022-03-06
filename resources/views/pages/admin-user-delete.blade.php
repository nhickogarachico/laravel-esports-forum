@extends('layouts.main')

@section('title', $user->username . ' | Edit')

@section('content')
    <div class="row">
        <div class="col-6 mx-auto">

            <h1>Delete User</h1>
            <p>You are trying to delete a user. All of his/her posts and comments will be deleted as well. Type your
                password to confirm.</p>
            <form action="/admin/users/{{ $user->id }}/delete" method="POST">
                @csrf
                @method('DELETE')
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <label for="password"></label>
                <input type="password" name="password" class="form-control">
                <button type="submit" class="btn btn-danger">Confirm</button>
            </form>
        </div>
    </div>
@endsection
