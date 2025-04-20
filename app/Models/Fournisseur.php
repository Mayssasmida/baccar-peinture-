<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'email', 'num_tel'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'id_fournisseur');
    }
}
