@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des demandes</h5>
            <a href="{{ route('admin.demandes.create') }}" class="btn btn-success">Ajouter une demande</a>
        </div>
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>Type d'Aliment</th>
                    <th class="d-none d-xl-table-cell">Quantité</th>
                    <th class="d-none d-xl-table-cell">Date</th>
                    <th class="d-none d-md-table-cell">Statut</th>
                    <th class="d-none d-md-table-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($demandes as $demande)
                    <tr>
                        <td>{{ $demande->type_aliment }}</td>
                        <td class="d-none d-xl-table-cell">{{ $demande->quantite }}</td>
                        <td class="d-none d-xl-table-cell">{{ $demande->date_demande }}</td>
                        <td>
                            @if($demande->statut == 'En attente')
                                <span class="badge badge-warning bg-danger">{{ $demande->statut }}</span>
                            @elseif($demande->statut == 'Approuvée')
                                <span class="badge badge-success bg-success">{{ $demande->statut }}</span>
                            @else
                                <span class="badge badge-secondary bg-secondary">{{ $demande->statut }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.demandes.edit', $demande->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('admin.demandes.destroy', $demande->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
