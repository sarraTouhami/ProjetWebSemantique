@extends('layouts.app')

@section('content')
    <h1>Liste des demandes</h1>
    <a href="{{ route('demandes.create') }}">Ajouter une nouvelle demande</a>

    <table>
        <thead>
            <tr>
                <th>ID Bénéficiaire</th>
                <th>Type d'Aliment</th>
                <th>Quantité</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($demandes as $demande)
                <tr>
                    <td>{{ $demande->beneficiaire_id }}</td>
                    <td>{{ $demande->type_aliment }}</td>
                    <td>{{ $demande->quantite }}</td>
                    <td>{{ $demande->date_demande }}</td>
                    <td>{{ $demande->statut }}</td>
                    <td>
                        <a href="{{ route('demandes.edit', $demande->id) }}">Modifier</a>
                        <form action="{{ route('demandes.destroy', $demande->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection