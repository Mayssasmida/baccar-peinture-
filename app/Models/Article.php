<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'image',
        'id_fournisseur',
        'id_categorie',
        'quantité',
        'prix_d_achat',
        'prix_de_vente'
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'id_fournisseur');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class, 'id_article');
    }
}