<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invertaireDonateur;

class InventaireDonateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invDonateur  = invertaireDonateur::all();
        return view ('InventaireDonateur.View',compact('invDonateur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('InventaireDonateur.AddInventaireDonateur');
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
            'nom_article' => 'required',
            'quantité' => 'required',
            'date_peremption' => 'required',
            'localisation' => 'required',
        ]);

        invertaireDonateur::create($request->all());

        return redirect()->route('invertaireDonateurs.index')->with('success', 'Article créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invDonateur = invertaireDonateur::find($id);
        return view('InventaireDonateur.showInventaireDonateur', compact('invDonateur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invDonateur = invertaireDonateur::find($id);
        return view('InventaireDonateur.Edit', compact('invDonateur'));
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
            'nom_article' => 'required',
            'quantité' => 'required',
            'date_peremption' => 'required',
            'localisation' => 'required',
        ]);

        $invDonateur = invertaireDonateur::find($id);
        $invDonateur->update($request->all());

        return redirect()->route('invertaireDonateurs.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        invertaireDonateur::find($id)->delete();

        return redirect()->route('invertaireDonateurs.index')->with('success', 'Article deleted successfully.');
    }
}
