@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="text-center mb-5">Recherche de Réservations</h1>

            <!-- Formulaire de recherche -->
            <form action="{{ route('reservation.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search_term" class="form-control" 
                           placeholder="Entrez un mot-clé (Statut, ID de réservation, etc.)" 
                           value="{{ request('search_term') }}" required>
                    <button type="submit" class="btn btn-primary px-4">Rechercher</button>
                </div>
            </form>
            <div class="text-end mb-4">
                <a href="{{ route('reservation.add') }}" class="btn btn-success">Ajouter une réservation</a>
            </div>

            @if($results->count() > 0)
                <h2 class="text-center mb-4">Résultats de la recherche</h2>

               <!-- Table des résultats -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Statut de la Réservation</th>
                                <th>Date de Réservation</th>
                                <th>Date de Livraison</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $reservation)
                                <tr>
                                    <td class="text-center">{{ $reservation['statusReserv']['value'] ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $reservation['dateReservation']['value'] ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $reservation['dateDeLivraison']['value'] ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
