@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Détails de la Réservation</h2>
        </div>
    </div>

    <div class="d-flex justify-content-center"> <!-- Centrer la carte -->
    <div class="card" style="width: 30rem;"> <!-- Élargir la carte -->
        <!-- Image de la réservation, assurez-vous de remplacer le chemin par une image appropriée -->
        <img src="{{ asset('img/Reservation.png') }}" class="card-img-top" alt="Image Reservation">

        <div class="card-body">
            <h5 class="card-title text-center">Réservation ID: {{ $reservation->id }}</h5>
            <p class="card-text">
                <strong>Bénéficiaire ID :</strong><br>
                {{ $reservation->beneficiare_id }}
            </p>
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Don ID :</strong> {{ $reservation->don_id }}</li>
            <li class="list-group-item"><strong>Date :</strong> {{ $reservation->date_reservation->format('d/m/Y H:i') }}</li>
            <li class="list-group-item"><strong>Statut :</strong> {{ ucfirst($reservation->statut_reservation) }}</li>
        </ul>

        <div class="card-body text-center"> <!-- Centrer le bouton -->
            <a href="{{ route('reservations.index') }}" class="btn btn-primary">Retour à la Liste</a>
        </div>
    </div>
</div>

</div>
@endsection
