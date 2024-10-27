@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
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

                <!-- Table des résultats -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Certification URI</th>
                                <th>Statut de la Certification</th>
                                <th>Date de Validation</th>
                                <th>Nom de la Certification</th>
                                <th>Description</th>
                                <th>Date de Création</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $certification)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ $certification['instance']['value'] ?? '#' }}" 
                                           target="_blank" class="text-decoration-none">
                                            {{ $certification['instance']['value'] ?? 'Lien non disponible' }}
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $certification['certifStatus']['value'] ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $certification['dateValidate']['value'] ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $certification['nomCertif']['value'] ?? 'N/A' }}</td>
                                    <td>{{ $certification['descriptionCertif']['value'] ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $certification['dateCreation']['value'] ?? 'N/A' }}</td>
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
