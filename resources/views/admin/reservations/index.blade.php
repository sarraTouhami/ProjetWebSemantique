@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des réservations</h5>
            <!-- <a href="{{ route('admin.reservations.create') }}" class="btn btn-success">Ajouter une réservation</a> -->
        </div>
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>Bénéficiaire_Id</th>
                    <th class="d-none d-xl-table-cell">Don_Id</th>
                    <th class="d-none d-xl-table-cell">Date de réservation</th>
                    <th class="d-none d-md-table-cell">Statut</th>
                    <th class="d-none d-md-table-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->beneficiare_id  ?? 'N/A' }}</td> <!-- Assuming you have a relation to fetch the beneficiary's name -->
                        <td class="d-none d-xl-table-cell">{{ $reservation->don_id  ?? 'N/A' }}</td> <!-- Assuming you have a relation to fetch the donation description -->
                        <td class="d-none d-xl-table-cell">{{ $reservation->date_reservation->format('d/m/Y') }}</td>
                        <td>
                            @if($reservation->statut_reservation == 'en_attente')
                                <span class="badge badge-warning bg-danger">{{ $reservation->statut_reservation }}</span>
                            @elseif($reservation->statut_reservation == 'approuvee')
                                <span class="badge badge-success bg-success">{{ $reservation->statut_reservation }}</span>
                            @else
                                <span class="badge badge-secondary bg-secondary">{{ $reservation->statut_reservation }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
