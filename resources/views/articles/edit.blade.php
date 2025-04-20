@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Article</h1>

    <!-- Display validation errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Article Name -->
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $article->nom) }}" required>
        </div>

        <!-- Article Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ old('description', $article->description) }}</textarea>
        </div>

        <!-- Article Image -->
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image" class="mt-2" width="100">
            @endif
        </div>

        <!-- Fournisseur (Supplier) -->
        <div class="mb-3">
            <label for="id_fournisseur" class="form-label">Fournisseur</label>
            <select class="form-select" id="id_fournisseur" name="id_fournisseur" required>
                @foreach($fournisseurs as $fournisseur)
                    <option value="{{ $fournisseur->id }}" {{ $article->id_fournisseur == $fournisseur->id ? 'selected' : '' }}>
                        {{ $fournisseur->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label for="id_categorie" class="form-label">Category</label>
            <select class="form-select" id="id_categorie" name="id_categorie" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $article->id_categorie == $category->id ? 'selected' : '' }}>
                        {{ $category->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label for="quantité" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantité" name="quantité" value="{{ old('quantité', $article->quantité) }}" required>
        </div>

        <!-- Purchase Price -->
        <div class="mb-3">
            <label for="prix_d_achat" class="form-label">Prix d'Achat</label>
            <input type="number" class="form-control" id="prix_d_achat" name="prix_d_achat" value="{{ old('prix_d_achat', $article->prix_d_achat) }}" step="0.01" required>
        </div>

        <!-- Selling Price -->
        <div class="mb-3">
            <label for="prix_de_vente" class="form-label">Prix de Vente</label>
            <input type="number" class="form-control" id="prix_de_vente" name="prix_de_vente" value="{{ old('prix_de_vente', $article->prix_de_vente) }}" step="0.01" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Article</button>
    </form>
</div>
@endsection
