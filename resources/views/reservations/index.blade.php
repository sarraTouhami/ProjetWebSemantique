@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px">
    <h1>Liste des demandes</h1>
    <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('reservations.create') }}" class="btn btn-primary "> <i class="fas fa-plus"></i>Ajouter une nouvelle demande</a>
    </div>
<div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Bénéficiaire ID</th>
                <th>Don ID</th>
                <th>Date de Réservation</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->beneficiare_id }}</td>
                    <td>{{ $reservation->don_id }}</td>
                    <td>{{ $reservation->date_reservation }}</td>
                    <td>{{ $reservation->statut_reservation }}</td>
                    <td>
                            <!-- Bouton Modifier -->
                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-sm btn-info mb-2">
                                <i class="fas fa-edit"></i> Modifier
                            </a>

                            <!-- Bouton Supprimer avec confirmation -->
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline-block;">
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
@endsection
