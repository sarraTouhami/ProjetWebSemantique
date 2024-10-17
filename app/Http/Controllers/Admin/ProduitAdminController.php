<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\ProduitAlimentaire;
use Illuminate\Http\Request;

class ProduitAdminController extends Controller
{
    //
    public function index()
    {
        $produits = ProduitAlimentaire::paginate(10);
        return view('admin.produits.index', compact('produits'));
    }
}
