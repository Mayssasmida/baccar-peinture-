<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vente extends Model
{
    use HasFactory;

    // Remarque : La colonne 'id_article' dans la base de données
    protected $fillable = ['id_article', 'quantité_vendue'];

    // Relation avec l'article (chaque vente appartient à un article)
    public function article()
    {
        return $this->belongsTo(Article::class, 'id_article');  // Utilisation du bon nom de colonne
    }

    // Méthode pour enregistrer une vente
    public static function recordSale($idArticle, $quantitéVendue)
    {
        // Récupérer l'article avec l'ID fourni
        $article = Article::findOrFail($idArticle);

        // Vérifier si le stock est suffisant
        if ($article->quantité < $quantitéVendue) {
            throw new \Exception("Stock insuffisant pour l'article.");
        }

        // Mettre à jour la quantité de l'article en stock
        $article->quantité -= $quantitéVendue;
        $article->save();

        // Créer l'enregistrement de la vente
        self::create([
            'id_article' => $idArticle,  // Assurez-vous que c'est bien 'id_article'
            'quantité_vendue' => $quantitéVendue,
        ]);
    }
}
