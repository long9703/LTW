<!-- resources/views/admin/users/show.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1>User Details</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Full Name</th>
            <td>{{ $user->fullname }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{ $user->phone_number }}</td>
        </tr>
        <tr>
            <th>Role</th>
            <td>{{ $user->role->name }}</td>
        </tr>
    </table>
@endsection
