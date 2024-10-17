@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px">
    <h1>Liste des réservations</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('reservations.create') }}" class="btn btn-primary"> <i class="fas fa-plus"></i> Ajouter une nouvelle réservation</a>
    </div>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une réservation..." onkeyup="filterReservations()">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
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

                            <!-- Bouton pour afficher la réservation -->
                            <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-sm btn-primary mb-2">
                                <i class="fas fa-eye"></i> Voir Détails
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
function filterReservations() {
    let input = document.getElementById('searchInput');
    let filter = input.value.toLowerCase();
    let table = document.querySelector('table');
    let tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) {
        let tdBeneficiareId = tr[i].getElementsByTagName('td')[0];
        let tdDonId = tr[i].getElementsByTagName('td')[1];
        let tdDateReservation = tr[i].getElementsByTagName('td')[2];
        let tdStatut = tr[i].getElementsByTagName('td')[3];

        if (tdBeneficiareId || tdDonId || tdDateReservation || tdStatut) {
            let textValue = (tdBeneficiareId.textContent || tdBeneficiareId.innerText) +
                            (tdDonId.textContent || tdDonId.innerText) +
                            (tdDateReservation.textContent || tdDateReservation.innerText) +
                            (tdStatut.textContent || tdStatut.innerText);
            if (textValue.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>
@endsection
