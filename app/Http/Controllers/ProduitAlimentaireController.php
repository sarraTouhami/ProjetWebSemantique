<?php

namespace App\Http\Controllers;
use App\Models\ProduitAlimentaire;
use Illuminate\Http\Request;

class ProduitAlimentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produitAlimentaire=ProduitAlimentaire::all();
        return view('produitAlimentaire.index',compact('produitAlimentaire'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produitAlimentaire.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'nom' => ['required','string','max:255'],
        'categorie' => ['required','string','max:255'],
        'quantite' => ['required','integer'],
        'date_peremption' => ['required', 'date'],
      ]);
      ProduitAlimentaire::create($request->all());
      return redirect()->route('produitAlimentaire.index')->with('success', 'Produit added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produitAlimentaire=ProduitAlimentaire::find($id);
        return view('produitAlimentaire.show',compact('produitAlimentaire'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produitAlimentaire=ProduitAlimentaire::find($id);
        return view('produitAlimentaire.edit',compact('produitAlimentaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
          'nom' => ['required','string','max:255'],
          'categorie' => ['required','string','max:255'],
          'quantite' => ['required','integer'],
          'date_peremption' => ['required', 'date'],
        ]);
        $produitAlimentaire=ProduitAlimentaire::find($id);
       

        $produitAlimentaire->update($request->all());
        return redirect()->route('produitAlimentaire.index')->with('success', 'Produit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProduitAlimentaire::find($id)->delete();
        return redirect()->route('produitAlimentaire.index')->with('success', 'Produit deleted successfully');
    }
}
