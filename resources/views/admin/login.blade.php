@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Login to Admin</h1>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <!-- Username & Password Input -->
            <input type="text" name="username" placeholder="Username" required class="form-control mb-2">
            <input type="password" name="password" placeholder="Password" required class="form-control mb-2">
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
@endsection
