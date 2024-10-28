@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <h1 class="text-center mb-5">Recherche de Certifications</h1>

            <!-- Formulaire de recherche -->
            <form action="{{ route('certification.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search_term" class="form-control" 
                           placeholder="Entrez un mot-clé (Label, Description, etc.)" 
                           value="{{ request('search_term') }}" required>
                    <button type="submit" class="btn btn-primary px-4">Rechercher</button>
                </div>
            </form>

            @if($results->count() > 0)
                <h2 class="text-center mb-4">Résultats de la recherche</h2>

                <!-- Cards pour les résultats -->
                <div class="row">
                    @foreach($results as $certification)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border border-dark rounded card-hover"> <!-- Ajout de la classe card-hover -->
                                <div class="card-body">
                                    <h5 class="card-title text-primary">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i> <!-- Icône Font Awesome -->
                                        {{ $certification['nomCertif']['value'] ?? 'N/A' }}
                                    </h5>
                                    <p class="card-text">
                                        <strong>Description:</strong> {{ $certification['descriptionCertif']['value'] ?? 'N/A' }}<br>
                                        <strong>Statut:</strong> 
                                        @php
                                            $statusClass = ($certification['certifStatus']['value'] ?? 'N/A') == 'Expiré' ? 'text-danger' : 'text-success';
                                        @endphp
                                        <span class="{{ $statusClass }}">
                                            {{ $certification['certifStatus']['value'] ?? 'N/A' }}
                                        </span><br>
                                        <strong>Date de Validation:</strong> {{ $certification['dateValidate']['value'] ?? 'N/A' }}<br>
                                        <strong>Date de Création:</strong> {{ $certification['dateCreation']['value'] ?? 'N/A' }}
                                    </p>
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

<style>
    .card-hover {
        transition: transform 0.2s; /* Animation douce pour l'effet de survol */
    }

    .card-hover:hover {
        transform: scale(1.05); /* Agrandissement au survol */
    }
</style>

@endsection
