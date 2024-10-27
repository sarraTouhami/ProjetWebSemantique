<?php

namespace App\Http\Controllers;
use App\Models\Demande;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demandes = Demande::all(); 
        return view('demandes.index', compact('demandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('demandes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'beneficiaire_id' => 'required',
            'type_aliment' => 'required',
            'quantite' => 'required|integer',
            'date_demande' => 'required|date',
            'statut' => 'required',
        ]);
    
        Demande::create($validated); 
        return redirect()->route('demandes.index')->with('success', 'Demande créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $demande = Demande::find($id);
        return view('demandes.show', compact('demande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $demande = Demande::find($id);
        return view('demandes.edit', compact('demande'));
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
        $validated = $request->validate([
            'beneficiaire_id' => 'required',
            'type_aliment' => 'required',
            'quantite' => 'required|integer',
            'date_demande' => 'required|date',
            'statut' => 'required',
        ]);
        $demande = Demande::find($id);
        $demande->update($request->all()); 
        return redirect()->route('demandes.index')->with('success', 'Demande mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Demande::find($id)->delete(); 
        return redirect()->route('demandes.index')->with('success', 'Demande supprimée avec succès');
    }
}
