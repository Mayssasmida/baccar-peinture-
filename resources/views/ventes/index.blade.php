@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sales</h1>
    <a href="{{ route('ventes.create') }}" class="btn btn-primary">Record Sale</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Article</th>
                <th>Quantity Sold</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventes as $vente)
            <tr>
                <td>{{ $vente->article->nom }}</td>
                <td>{{ $vente->quantité_vendue }}</td>  
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
