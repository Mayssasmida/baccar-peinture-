@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->nom }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
