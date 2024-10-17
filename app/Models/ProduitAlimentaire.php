<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProduitAlimentaire extends Model
{
    use HasFactory;
    protected $table = 'produits_alimentaires';
    protected $fillable = [
        'user_id',
        'nom',
        'categorie',
        'quantite',
        'date_peremption',
        'type',
        'image_url',
    ];

}
