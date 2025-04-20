<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Article;
use Illuminate\Http\Request;
use Exception;

class VenteController extends Controller
{
    // Afficher toutes les ventes
    public function index()
    {
        $ventes = Vente::with('article')->get();
        return view('ventes.index', compact('ventes'));
    }

    // Afficher le formulaire pour créer une nouvelle vente
    public function create()
    {
        // Récupérer tous les articles pour le formulaire
        $articles = Article::all();
        return view('ventes.create', compact('articles'));
    }

    // Enregistrer la vente et mettre à jour le stock
    public function store(Request $request)
    {
        // Valider les données entrées
        $request->validate([
            'id_article' => 'required|exists:articles,id',  // Assurez-vous que la colonne porte bien ce nom dans votre base
            'quantity_sold' => 'required|integer|min:1',
        ]);

        // Essayer d'enregistrer la vente
        try {
            // Appeler la méthode du modèle pour enregistrer la vente
            Vente::recordSale($request->id_article, $request->quantity_sold);

            // Rediriger vers l'index des ventes avec un message de succès
            return redirect()->route('ventes.index')->with('success', 'Vente enregistrée avec succès.');
        } catch (Exception $e) {
            // En cas d'erreur (par exemple, stock insuffisant), retourner un message d'erreur
            return redirect()->route('ventes.create')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
