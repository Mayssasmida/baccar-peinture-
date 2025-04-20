@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Fournisseurs</h1>
    <a href="{{ route('fournisseurs.create') }}" class="btn btn-primary">Add New Fournisseur</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fournisseurs as $fournisseur)
            <tr>
                <td>{{ $fournisseur->nom }}</td>
                <td>{{ $fournisseur->email }}</td>
                <td>{{ $fournisseur->num_tel }}</td>
                <td>
                    <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST" class="d-inline">
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
