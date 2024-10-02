@extends('layouts.app')

@section('content')
   <div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px">
    <h1>Liste des demandes</h1>
    <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('demandes.create') }}" class="btn btn-primary "> <i class="fas fa-plus"></i>Ajouter une nouvelle demande</a>
    </div>
<div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
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
                        <td>{{ $demande->type_aliment }}</td>
                        <td>{{ $demande->quantite }}</td>
                        <td>{{ $demande->date_demande }}</td>
                        <td>
                            <!-- @if($demande->statut == 'En attente')
                                <span class="badge badge-warning">En attente</span>
                            @elseif($demande->statut == 'Approuvée')
                                <span class="badge badge-success">Approuvée</span>
                            @else
                                <span class="badge badge-secondary">{{ $demande->statut }}</span>
                            @endif -->
                            <div class="d-flex">
                        @if ($demande->statut === 'en attente')
                        <span class="text-secondary border-2 py-2 px-4 rounded-pill">
                            {{ $demande->statut }}
                        </span>
                        @else
                        <span class="text-primary border-2 py-2 px-4 rounded-pill">
                            {{ $demande->statut }}
                         </span>
                         @endif
                        </div>
                        </td>
                        <td>
                            <!-- Bouton Modifier -->
                            <a href="{{ route('demandes.edit', $demande->id) }}" class="btn btn-sm btn-info mb-2">
                                <i class="fas fa-edit"></i> Modifier
                            </a>

                            <!-- Bouton Supprimer avec confirmation -->
                            <form action="{{ route('demandes.destroy', $demande->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection