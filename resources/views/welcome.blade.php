@extends('layouts.app')

@section('content')
<!-- Bootstrap jumbotron -->
<div class="jumbotron text-center">
    <h1>Welcome to My Notes</h1>
    <p>This is a simple web application to manage your notes</p>
    <p>
        <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Register</a>
        <a class="btn btn-success btn-lg" href="{{ route('login') }}" role="button">Login</a>
    </p>
</div>
@endsection
