@extends('layouts.main')

@section('content')
    <div>


        Home

        @if (session('registerMessage'))
            {{ session('registerMessage') }}
        @endif
    </div>
@endsection
