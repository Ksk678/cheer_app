@extends('layouts.app2')

<link href="{{ asset('css/style.css') }}" rel="stylesheet">


@section('content')
    <div class="container" style="display: flex; justify-content: center; align-items: center; height: 80vh;">
        <div class="text-center">
            <h1>Welcome to Huntsman</h1>
            <p>Discover and showcase rugby talent.</p>

            <div class="mt-4">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Register</a>
                <a href="{{ route('login') }}" class="btn btn-secondary btn-lg ml-3">Login</a>
            </div>
        </div>
    </div>
@endsection
