@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Ajouter une Réservation</h1>
    
    <form action="{{ route('reservation.addReserv') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="status_reserv" class="form-label">Statut de la Réservation</label>
            <select name="status_reserv" id="status_reserv" class="form-control" required>
                <option value="" disabled selected>Sélectionnez un statut</option>
                <option value="Confirmée">Confirmée</option>
                <option value="Réservée">Réservée</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="date_reservation" class="form-label">Date de Réservation</label>
            <input type="date" name="date_reservation" id="date_reservation" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="Date_de_livraison" class="form-label">Date de Livraison</label>
            <input type="date" name="Date_de_livraison" id="Date_de_livraison" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Ajouter la Réservation</button>
        <a href="{{ route('reservation.search') }}" class="btn btn-secondary">Retourner à la recherche</a>
    </form>
</div>
@endsection
