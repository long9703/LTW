@extends('layouts.admin')

@section('content')
    <div class="mt-4">
        <h2>Category Detail</h2>
        <p><strong>ID:</strong> {{ $category->id }}</p>
        <p><strong>Name:</strong> {{ $category->name }}</p>
        <p><strong>Description:</strong> {{ $category->description }}</p>

        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
