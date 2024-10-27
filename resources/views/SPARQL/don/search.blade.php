@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h4 class="mb-4 mt-5">Recherche de Dons</h4>

            <!-- Formulaire de recherche -->
            <form action="{{ route('don.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search_term" class="form-control" 
                           placeholder="Entrez un mot-clé (Statut, Type, etc.)" 
                           value="{{ request('search_term') }}" required>
                    <button type="submit" class="btn btn-primary px-4">Rechercher</button>
                </div>
            </form>

            <!-- Bouton pour ajouter un don -->
            <div class="text-end mb-4">
                <a href="{{ route('don.create') }}" class="btn btn-success">Ajouter un Don</a>
            </div>

            @if($results->count() > 0)
                <!-- Affichage sous forme de cartes -->
                <div class="row">
                    @foreach($results as $donation)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <strong>Type d'Aliment:</strong> {{ $donation['type_aliment']['value'] ?? 'N/A' }}
                                    </h5>
                                    <p class="card-text">
                                        <strong>Statut du Don:</strong> {{ $donation['statut_don']['value'] ?? 'N/A' }}<br>
                                        <strong>Quantité:</strong> {{ $donation['quantité']['value'] ?? 'N/A' }}<br>
                                        <strong>Date de Péremption:</strong> {{ $donation['date_permption']['value'] ?? 'N/A' }}<br>
                                        <strong>Date du Don:</strong> {{ $donation['date_don']['value'] ?? 'N/A' }}<br>
                                    </p>
                                    
                                    <!-- Buttons for Edit and Delete -->
                                    <div class="d-flex justify-content-between">
                                        <a  class="btn btn-warning btn-sm">Modifier</a>
                                        <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce don ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Liens de pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $results->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="alert alert-warning text-center mt-5" role="alert">
                    <h4>Aucun résultat trouvé.</h4>
                    <p>Veuillez réessayer avec un autre mot-clé.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
