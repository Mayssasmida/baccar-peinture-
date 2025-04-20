@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Article</h1>
    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nom">Article Name</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="id_fournisseur">Fournisseur</label>
            <select name="id_fournisseur" id="id_fournisseur" class="form-control">
                @foreach ($fournisseurs as $fournisseur)
                    <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_categorie">Category</label>
            <select name="id_categorie" id="id_categorie" class="form-control">
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantité">Stock Quantity</label>
            <input type="number" name="quantité" id="quantité" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="prix_d_achat">Purchase Price</label>
            <input type="number" name="prix_d_achat" id="prix_d_achat" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="prix_de_vente">Selling Price</label>
            <input type="number" name="prix_de_vente" id="prix_de_vente" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Create</button>
    </form>
</div>
@endsection
