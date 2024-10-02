<!-- resources/views/reservations/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 text-center">Modifier la Réservation</h2>
            </div>
        </div>
        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Méthode PUT pour la mise à jour -->
            
            <!-- Bénéficiaire ID -->
            <div class="form-group">
                <label for="beneficiare_id">Bénéficiaire ID</label>
                <input type="number" name="beneficiare_id" id="beneficiare_id" class="form-control" value="{{ $reservation->beneficiare_id }}" required>
            </div>

            <!-- Don ID -->
            <div class="form-group">
                <label for="don_id">Don ID</label>
                <input type="number" name="don_id" id="don_id" class="form-control" value="{{ $reservation->don_id }}" required>
            </div>

            <!-- Date de Réservation -->
            <div class="form-group">
                <label for="date_reservation">Date de Réservation</label>
                <input type="date" name="date_reservation" id="date_reservation" class="form-control" 
                    value="{{ $reservation->date_reservation ? $reservation->date_reservation->format('Y-m-d') : '' }}" required>
            </div>


            <!-- Statut de Réservation -->
            <div class="form-group">
                <label for="statut_reservation">Statut de la Réservation</label>
                <select name="statut_reservation" id="statut_reservation" class="form-control" required>
                    <option value="en_attente" {{ $reservation->statut_reservation == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                    <option value="confirmé" {{ $reservation->statut_reservation == 'confirmé' ? 'selected' : '' }}>Confirmé</option>
                    <option value="completé" {{ $reservation->statut_reservation == 'completé' ? 'selected' : '' }}>Completé</option>
                    <option value="annulee" {{ $reservation->statut_reservation == 'annulee' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>

            <!-- Bouton de mise à jour -->
            <button type="submit" class="btn btn-primary">Mettre à jour la Réservation</button>
        </form>
    </div>
</div>
@endsection
