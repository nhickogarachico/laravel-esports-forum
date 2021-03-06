@extends('layouts.main')

@section('title', 'Register')

@section('content')
    <div class="row">
        <div class="col mx-auto">
            <div class="login-container mx-auto">
                <h1>Sign Up</h1>
                <form action="/register" method="POST" class="mb-2">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <div class="mb-2">
                        <label for="username">Username</label>
                        <input id="username" type="text" class="form-control" name="username"
                            value="{{ old('username') }}" />
                    </div>
                    <div class="mb-2">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" />
                    </div>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" />
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </form>
                <p>Already have an account? <a href="/login">Log in</a></p>
            </div>
        </div>
    </div>
@endsection
