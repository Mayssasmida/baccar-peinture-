@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Fournisseur</h1>
    <form action="{{ route('fournisseurs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Fournisseur Name</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="num_tel">Phone Number</label>
            <input type="text" name="num_tel" id="num_tel" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Create</button>
    </form>
</div>
@endsection
