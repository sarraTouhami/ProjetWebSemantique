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
        // Validate the incoming request
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'categorie' => ['required', 'string', 'max:255'],
            'quantite' => ['required', 'integer'],
            'date_peremption' => ['required', 'date'],
            'type' => ['required', 'string'],
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif|max:2048', 
        ]);
    
        $imagePath = null;
    
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            $imagePath = $image->storeAs('public/img', $imageName);
            $imagePath = str_replace('public/', 'storage/', $imagePath);
        }
    
        // Create the produit
        ProduitAlimentaire::create([
            'nom' => $request->input('nom'),
            'categorie' => $request->input('categorie'),
            'quantite' => $request->input('quantite'),
            'date_peremption' => $request->input('date_peremption'),
            'type' => $request->input('type'),
            'image_url' => $imagePath,
        ]);
    
        return redirect()->route('produitAlimentaire.index')->with('success', 'Produit ajouté avec succès!');
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
        $produitAlimentaire = ProduitAlimentaire::find($id);
        if (!$produitAlimentaire) {
            return redirect()->route('produitAlimentaire.index')->with('error', 'Produit non trouvé.');
        }
        return view('produitAlimentaire.edit', compact('produitAlimentaire'));
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
            'nom' => ['required', 'string', 'max:255'],
            'categorie' => ['required', 'string', 'max:255'],
            'quantite' => ['required', 'integer'],
            'date_peremption' => ['required', 'date'],
            'type' => ['required', 'string'],
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif|max:2048', 
        ]);
    
        $produitAlimentaire = ProduitAlimentaire::find($id);
        if (!$produitAlimentaire) {
            return redirect()->route('produitAlimentaire.index')->with('error', 'Produit non trouvé.');
        }
        $imagePath = $produitAlimentaire->image_url; 
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/images', $imageName);
            $imagePath = str_replace('public/', 'storage/', $imagePath);
        }

        $produitAlimentaire->update([
            'nom' => $request->input('nom'),
            'categorie' => $request->input('categorie'),
            'quantite' => $request->input('quantite'),
            'date_peremption' => $request->input('date_peremption'),
            'type' => $request->input('type'),
            'image_url' => $imagePath, 
        ]);
    
        return redirect()->route('produitAlimentaire.index')->with('success', 'Produit mis à jour avec succès');
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
