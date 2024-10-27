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

            <!-- Results Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Demande</th>
                        <th>Date de Demande</th>
                        <th>Statut</th>
                        <th>Type Aliment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result['demande']['value'] }}</td>
                            <td>{{ $result['data_de_demande']['value'] ?? 'N/A' }}</td>
                            <td>{{ $result['statut']['value'] ?? 'N/A' }}</td>
                            <td>{{ $result['type_aliment']['value'] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            {{ $results->links() }}
        </div>
    </div>
</div>
@endsection
