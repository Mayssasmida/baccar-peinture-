@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Articles</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary">Add New Article</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td>
                    @if ($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image" width="50" height="50">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>{{ $article->nom }}</td>
                <td>{{ $article->description }}</td>
                <td>{{ $article->quantité }}</td>
                <td>{{ $article->prix_de_vente }} TND</td>
                
                <td>
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
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
