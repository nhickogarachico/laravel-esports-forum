@extends('layouts.main')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col mx-auto">
            <div class="login-container mx-auto">
                <h1>Log in</h1>
                <form action="/login" method="POST" class="mb-2">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <div class="mb-2">
                        <label for="credentials">Username or email</label>
                        <input id="credentials" type="text" class="form-control" name="credentials"
                            value="{{ old('credentials') }}" />
                    </div>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" />
                    </div>
                    <button type="submit" class="btn btn-primary">Log in</button>
                </form>
                <p>Don't have an account? <a href="/register">Sign Up</a></p>
            </div>
        </div>
    </div>
@endsection
