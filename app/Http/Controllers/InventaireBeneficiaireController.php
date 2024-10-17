<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventaireBeneficiaire;
class InventaireBeneficiaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventaires = InventaireBeneficiaire::all();
        return view('inventaire_benfsiaire.index', compact('inventaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventaire_benfsiaire.create');
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
            'nom_article' => 'required|string',
            'quantite' => 'required|integer',
            'date_peremption' => 'required|date',
            'localisation' => 'required|string',
        ]);

        InventaireBeneficiaire::create($request->all());
        return redirect()->route('inventaires-beneficiaires.index')->with('success', 'Article ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('inventaire_benfsiaire.show', compact('inventaireBeneficiaire'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $inventaireBeneficiaire = InventaireBeneficiaire::find($id);
        return view('inventaire_benfsiaire.edit', compact('inventaireBeneficiaire'));
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
            'nom_article' => 'required|string',
            'quantite' => 'required|integer',
            'date_peremption' => 'required|date',
            'localisation' => 'required|string',
        ]);

        $inventaireBeneficiaire=InventaireBeneficiaire::find($id);
        $inventaireBeneficiaire->update($request->all()); 
        return redirect()->route('inventaires-beneficiaires.index')->with('success', 'Article mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InventaireBeneficiaire::find($id)->delete(); 

        return redirect()->route('inventaires-beneficiaires.index')->with('success', 'Article supprimé avec succès');
    }
}
