<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invertaireDonateur extends Model
{
    use HasFactory;
    protected $table = 'inventaire_donateur';
    protected $primaryKey ='id';
    protected $fillable = ['nom_article', 'quantité' , 'date_peremption' , 'localisation' ];
}
