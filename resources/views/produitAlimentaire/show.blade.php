@extends('layouts.app') <!-- Make sure you have a layout file -->

@section('content')
<div  class=" p-4 mb-5" data-wow-delay="0.1s" style="margin-top: 100px;">
    <h1>Détails du produit</h1>
    
    <div class="bg-white h-100 p-4 p-xl-5 mb-3">

    
    <h3 class="mb-3">{{ $produitAlimentaire->nom }}</h3>
    
    <p class="mb-2"><strong>Catégorie:</strong> {{ $produitAlimentaire->categorie }}</p>
    <p class="mb-2"><strong>Quantité:</strong> {{ $produitAlimentaire->quantite }}</p>
    <p class="mb-4"><strong>Date d'expiration:</strong> {{ $produitAlimentaire->date_peremption }}</p>
    
    <a href="{{ route('produitAlimentaire.edit', $produitAlimentaire->id) }}"class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill">Edit</a>
   
    <form action="{{ route('produitAlimentaire.destroy', $produitAlimentaire->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit"class="btn btn-outline-danger border-2 py-2 px-4 rounded-pill" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément?')">Delete</button>
    </form>
    <a href="{{ route('produitAlimentaire.index') }}"class="btn btn-outline-secondary border-2 py-2 px-4 rounded-pill">Back to List</a>  
</div>

   
</div>
@endsection
