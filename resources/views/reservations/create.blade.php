@extends('layouts.app')

@section('title', 'Add Reservation')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Ajouter une Réservation</h2>
        </div>
    </div>

    <!-- Formulaire d'ajout de réservation -->
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf <!-- Protection CSRF de Laravel -->
        
        <!-- Bénéficiaire ID -->
        <div class="form-group mb-3">
            <label for="beneficiare_id">Bénéficiaire ID</label>
            <input type="text" name="beneficiare_id" id="beneficiare_id" class="form-control" placeholder="Entrez l'ID du bénéficiaire" required>
        </div>

        <!-- Don ID -->
        <div class="form-group mb-3">
            <label for="don_id">Don ID</label>
            <input type="text" name="don_id" id="don_id" class="form-control" placeholder="Entrez l'ID du don" required>
        </div>

        <!-- Date de Réservation -->
        <div class="form-group mb-3">
            <label for="date_reservation">Date de Réservation</label>
            <input type="date" name="date_reservation" id="date_reservation" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
        </div>

        
        <div class="form-group mb-3">
            <label for="statut_reservation">Statut de la Réservation</label>
            <select name="statut_reservation" id="statut_reservation" class="form-control" required>
                <option value="en_attente">En Attente</option>
                <option value="confirmé">Confirmé</option>
                <option value="completé">Completé</option>
                <option value="annulee">Annulée</option>
            </select>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary btn-block">Ajouter la Réservation</button>
    </form>
</div>
@endsection
