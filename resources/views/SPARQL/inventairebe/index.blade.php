@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <h1 class="text-center mb-5">Inventaire des Bénéficiaires</h1>

            <!-- Bouton pour ajouter un nouvel article -->
            <a href="{{ route('inventairebe.create') }}" class="btn btn-primary mb-4">Ajouter un Article</a>

            <!-- Affichage des résultats -->
            <div class="row">
                @foreach($inventaires as $inventaire)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text"><strong>Nom de l'Article:</strong> {{ $inventaire['non_article']['value'] ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Quantité:</strong> {{ $inventaire['quantite_inventaire']['value'] ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Date de Péremption:</strong> {{ $inventaire['date_permption']['value'] ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Location:</strong> {{ $inventaire['location']['value'] ?? 'N/A' }}</p>

                                <!-- Section Affectation des Produits -->
                                <h5 class="mt-4">Affectation des Produits</h5>
                                <ul>
                                    @if(isset($inventaire['produit']))
                                        <li>
                                            <strong>Nom du Produit:</strong> {{ $inventaire['nom_aliment']['value'] ?? 'Nom du produit inconnu' }} - 
                                            <strong>Quantité:</strong> {{ $inventaire['quantite_produit']['value'] ?? 'N/A' }}
                                        </li>
                                    @else
                                        <li>Aucun produit affecté</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
