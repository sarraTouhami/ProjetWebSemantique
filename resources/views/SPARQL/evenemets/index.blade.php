{{-- resources/views/sparql/evenemets/index.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mt-5"> <!-- Added margin top here -->
    <h4>Liste des Événements</h4>

    <!-- Add Event Button -->
    <div class="mb-3">
        <a href="{{ route('evenemets.create') }}" class="btn btn-success">Ajouter un Événement</a>
    </div>

    <!-- Search Form -->
    <form action="{{ route('evenemets.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher un événement" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>

    @if (count($results) > 0)
    <table class="table">
        <thead>
        <tr>
            <th>Nom de l'Événement</th>
            <th>Lieu</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($results as $event)
        <tr>
            <td>{{ $event['Event_Name']['value'] ?? 'N/A' }}</td>
            <td>{{ $event['Event_Location']['value'] ?? 'N/A' }}</td>
            <td>{{ $event['Event_Description']['value'] ?? 'N/A' }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    <p>Aucun événement trouvé.</p>
    @endif
</div>
@endsection
