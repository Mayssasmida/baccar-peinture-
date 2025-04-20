<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Vente;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $topSellingArticles = Vente::select('id_article', DB::raw('SUM(quantité_vendue) as total_sales'))
            ->groupBy('id_article')
            ->orderByDesc('total_sales')
            ->limit(4)  // Limit to top 4 articles
            ->get()
            ->map(function ($sale) {
                $sale->article = Article::find($sale->id_article);
                return $sale;
            });

        // Unavailable Articles (quantity = 0)
        $unavailableArticles = Article::where('quantité', 0)->get();

        // Articles with quantity < 10
        $articlesBelowTen = Article::where('quantité', '>', 0)
            ->where('quantité', '<', 10)
            ->get();

        // Monthly and Yearly Profit Calculation
        $monthlyProfit = Vente::select(DB::raw('MONTH(ventes.created_at) as month'), DB::raw('SUM(ventes.quantité_vendue * articles.prix_de_vente) as total_profit'))
            ->join('articles', 'ventes.id_article', '=', 'articles.id')  // Join with the articles table
            ->groupBy(DB::raw('MONTH(ventes.created_at)'))
            ->orderBy('month')
            ->get();


        $yearlyProfit = Vente::select(DB::raw('YEAR(ventes.created_at) as year'), DB::raw('SUM(ventes.quantité_vendue * articles.prix_de_vente) as total_profit'))
            ->join('articles', 'ventes.id_article', '=', 'articles.id')  // Join with the articles table
            ->groupBy(DB::raw('YEAR(ventes.created_at)'))
            ->orderBy('year')
            ->get();

        $articlesByCategory = Article::select('categories.nom as category_name', DB::raw('count(*) as total'))
            ->join('categories', 'articles.id_categorie', '=', 'categories.id')  // Vérifier que la table s'appelle 'categories'
            ->groupBy('categories.nom')  // Utiliser 'categories.nom' pour récupérer le nom
            ->get();


        $articlesBySupplier = Article::select('fournisseurs.nom as supplier_name', DB::raw('count(*) as total'))
            ->join('fournisseurs', 'articles.id_fournisseur', '=', 'fournisseurs.id')  // Joindre la table 'fournisseur'
            ->groupBy('fournisseurs.nom')  // Utiliser 'fournisseur.nom' pour récupérer le nom
            ->get();

        return view('dashboard', compact(
            'topSellingArticles',
            'unavailableArticles',
            'articlesBelowTen',
            'monthlyProfit',
            'yearlyProfit',
            'articlesByCategory',
            'articlesBySupplier'
        ));
    }
}
