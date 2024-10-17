@extends('layouts.app') <!-- Make sure you have a layout file -->

@section('content')
<div class="p-4 mb-5" data-wow-delay="0.1s" style="margin-top: 100px;">
    <h1 class="text-center">Détails du produit</h1>
    
    <div class="bg-white h-100 p-4 p-xl-5 mb-3 d-flex">
      
        <div class="me-4" style="flex-shrink: 0;"> 
            @if (!empty($produitAlimentaire->image_url))
                <img src="{{ asset($produitAlimentaire->image_url) }}" alt="{{ $produitAlimentaire->nom }}" class="img-fluid" style="max-width: 300px;">
            @else
                <img src="https://via.placeholder.com/300" alt="Image non disponible" class="img-fluid" style="max-width: 300px;">
            @endif
        </div>

        <div>
            <h3 class="mb-3">{{ $produitAlimentaire->nom }}</h3>
            
            @if (!empty($produitAlimentaire->categorie)) <!-- Check if categorie is not null -->
                <p class="mb-2"><strong>Catégorie:</strong> {{ $produitAlimentaire->categorie }}</p>
            @endif

            <p class="mb-2"><strong>Type:</strong> {{ $produitAlimentaire->type }}</p> <!-- Display Type -->
            <p class="mb-2"><strong>Quantité:</strong> {{ $produitAlimentaire->quantite }}</p>
            <p class="mb-4"><strong>Date d'expiration:</strong> {{ $produitAlimentaire->date_peremption }}</p>
        
            <a href="{{ route('produitAlimentaire.index') }}" class="btn btn-outline-secondary border-2 py-2 px-4 rounded-pill">Back to List</a>  
        </div>
    </div>
</div>
@endsection
