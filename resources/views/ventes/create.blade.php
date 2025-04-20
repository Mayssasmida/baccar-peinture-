<!-- resources/views/ventes/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Créer une Vente</h2>

        <!-- Affichage des messages d'erreur ou de succès -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('ventes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_article">Article</label>
                <select name="id_article" id="id_article" class="form-control" required>
                    @foreach($articles as $article)
                        <option value="{{ $article->id }}">{{ $article->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="quantity_sold">Quantité vendue</label>
                <input type="number" name="quantity_sold" id="quantity_sold" class="form-control" required min="1">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Enregistrer la Vente</button>
        </form>
    </div>
@endsection
