@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4>Liste des Recommandations</h4>

    <div class="mb-3">
        <a href="{{ route('recommendation.create') }}" class="btn btn-success">Ajouter un Événement</a>
    </div>
    <!-- Search Form -->
    <form action="{{ route('recommendation.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher une recommandation" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>

    @if (count($results) > 0)
    <table class="table">
        <thead>
        <tr>
            <th>Contenu</th>
            <th>Type</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($results as $recommendation)
        <tr>
            <td>{{ $recommendation['contenu']['value'] ?? 'N/A' }}</td>
            <td>{{ $recommendation['type_Recommendation']['value'] ?? 'N/A' }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    <p>Aucune recommandation trouvée.</p>
    @endif
</div>
@endsection
