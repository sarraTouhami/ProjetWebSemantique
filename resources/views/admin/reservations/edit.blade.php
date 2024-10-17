@extends('admin.layouts.app')

@section('title', 'Modifier la Réservation')

@section('content')
<div class="container mt-5">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Modifier la Réservation</h5>
        </div>
        <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">

                <!-- Bénéficiaire ID -->
                <div class="form-group">
                    <label for="beneficiare_id">ID du bénéficiaire</label>
                    <input type="number" name="beneficiare_id" class="form-control @error('beneficiare_id') is-invalid @enderror" value="{{ $reservation->beneficiare_id }}" required>
                    @error('beneficiare_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Don ID -->
                <div class="form-group">
                    <label for="don_id">ID du don</label>
                    <input type="number" name="don_id" class="form-control @error('don_id') is-invalid @enderror" value="{{ $reservation->don_id }}" required>
                    @error('don_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date de Réservation -->
                <div class="form-group">
                    <label for="date_reservation">Date de la réservation</label>
                    <input type="date" name="date_reservation" class="form-control @error('date_reservation') is-invalid @enderror" value="{{ $reservation->date_reservation->format('Y-m-d') }}" required>
                    @error('date_reservation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Statut de la Réservation -->
                <div class="form-group">
                    <label for="statut_reservation">Statut de la réservation</label>
                    <select name="statut_reservation" class="form-control @error('statut_reservation') is-invalid @enderror" required>
                        <option value="en_attente" {{ $reservation->statut_reservation == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="confirmee" {{ $reservation->statut_reservation == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                        <option value="annulee" {{ $reservation->statut_reservation == 'annulee' ? 'selected' : '' }}>Annulée</option>
                    </select>
                    @error('statut_reservation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
