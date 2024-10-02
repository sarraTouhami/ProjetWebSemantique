<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventaireBeneficiaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_article',     
        'quantite',         
        'date_peremption',  
        'localisation',     
    ];
}
