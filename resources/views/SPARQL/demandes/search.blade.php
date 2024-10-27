@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="text-center mb-5">Recherche de Demandes</h1>

            <!-- Search Form with Input and Checkbox Filters -->
            <form action="{{ route('demande.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <!-- Input field for keyword search -->
                    <input type="text" name="search_term" class="form-control" 
                           placeholder="Entrez un mot-clé (nom, statut, etc.)" 
                           value="{{ request()->input('search_term') }}">
                    <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
                </div>
                <div class="mt-3">
                    <h5>Filtrer par statut :</h5>
                    <!-- Checkbox filters for statuses -->
                    @foreach($statuts as $statut)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   name="statut[]" value="{{ $statut }}" 
                                   id="statut_{{ $statut }}"
                                   {{ in_array($statut, request()->input('statut', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="statut_{{ $statut }}">
                                {{ ucfirst($statut) }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </form>

            <!-- Results Display with Cards -->
            <div class="row">
                @foreach($results as $result)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                
                                <p class="card-text"><strong>Date de Demande:</strong> {{ $result['data_de_demande']['value'] ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Statut:</strong> {{ $result['statut']['value'] ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Type Aliment:</strong> {{ $result['type_aliment']['value'] ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            {{ $results->links() }}
        </div>
    </div>
</div>
@endsection
