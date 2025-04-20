<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['categorie', 'fournisseur'])->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();
        return view('articles.create', compact('categories', 'fournisseurs'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // Validation pour les images
            'id_fournisseur' => 'required|exists:fournisseurs,id',
            'id_categorie' => 'required|exists:categories,id',
            'quantité' => 'required|integer|min:0',
            'prix_d_achat' => 'required|numeric|min:0',
            'prix_de_vente' => 'required|numeric|min:0',
        ]);

        // Récupération des données
        $data = $request->all();

        // Gestion de l'image
        if ($request->hasFile(key: 'image')) {
            // Stocker l'image et obtenir le chemin de stockage
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        // Création de l'article
        Article::create($data);

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();
        return view('articles.edit', compact('article', 'categories', 'fournisseurs'));
    }

    public function update(Request $request, Article $article)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // Validation pour les images
            'id_fournisseur' => 'required|exists:fournisseurs,id',
            'id_categorie' => 'required|exists:categories,id',
            'quantité' => 'required|integer|min:0',
            'prix_d_achat' => 'required|numeric|min:0',
            'prix_de_vente' => 'required|numeric|min:0',
        ]);

        // Récupération des données
        $data = $request->all();

        // Si une nouvelle image est téléchargée
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($article->image && Storage::exists('public/' . $article->image)) {
                Storage::delete('public/' . $article->image);
            }

            // Stocker la nouvelle image
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        // Mise à jour de l'article
        $article->update($data);

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        // Suppression de l'article et de son image si elle existe
        if ($article->image && Storage::exists('public/' . $article->image)) {
            Storage::delete('public/' . $article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
