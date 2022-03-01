@extends('layouts.main')

@section('title', "@yield('title')")

@section('content')
    <div class="row">
        <div class="col-md-3">
            <x-profile-card :user="$user"></x-profile-card>
        </div>
        <div class="col">
            @yield('profile-content')
        </div>
    </div>

@endsection
