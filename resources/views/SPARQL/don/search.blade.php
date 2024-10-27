@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="text-center mb-5">Recherche de Dons</h1>

            <!-- Formulaire de recherche -->
            <form action="{{ route('don.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search_term" class="form-control" 
                           placeholder="Entrez un mot-clé (Statut, Type, etc.)" 
                           value="{{ request('search_term') }}" required>
                    <button type="submit" class="btn btn-primary px-4">Rechercher</button>
                </div>
            </form>

            @if($results->count() > 0)
                <h2 class="text-center mb-4">Résultats de la recherche</h2>

                <!-- Table des résultats -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Donation URI</th>
                                <th>Statut du Don</th>
                                <th>Quantité</th>
                                <th>Date de Péremption</th>
                                <th>Date du Don</th>
                                <th>Type d'Aliment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $donation)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ $donation['instance']['value'] ?? '#' }}" 
                                           target="_blank" class="text-decoration-none">
                                            {{ $donation['instance']['value'] ?? 'Lien non disponible' }}
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $donation['statut_don']['value'] ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $donation['quantité']['value'] ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $donation['date_permption']['value'] ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $donation['date_don']['value'] ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $donation['type_aliment']['value'] ?? 'N/A' }}</td>
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
