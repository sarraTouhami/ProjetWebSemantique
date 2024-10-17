@extends('admin.layouts.app')

@section('title', 'Modifier la demande')

@section('content')
<div class="container mt-5">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Modifier la demande</h5>
        </div>
        <form action="{{ route('admin.demandes.update', $demande->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                
                <!-- Beneficiaire ID -->
                <div class="form-group">
                    <label for="beneficiaire_id">ID du bénéficiaire</label>
                    <input type="number" name="beneficiaire_id" class="form-control @error('beneficiaire_id') is-invalid @enderror" value="{{ $demande->beneficiaire_id }}" required>
                    @error('beneficiaire_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Type Aliment -->
                <div class="form-group">
                    <label for="type_aliment">Type d'aliment</label>
                    <input type="text" name="type_aliment" class="form-control @error('type_aliment') is-invalid @enderror" value="{{ $demande->type_aliment }}" required>
                    @error('type_aliment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Quantité -->
                <div class="form-group">
                    <label for="quantite">Quantité</label>
                    <input type="number" name="quantite" class="form-control @error('quantite') is-invalid @enderror" value="{{ $demande->quantite }}" required>
                    @error('quantite')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date Demande -->
                <div class="form-group">
                    <label for="date_demande">Date de la demande</label>
                    <input type="date" name="date_demande" class="form-control @error('date_demande') is-invalid @enderror" value="{{ $demande->date_demande }}" required>
                    @error('date_demande')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Statut -->
                <div class="form-group">
                    <label for="statut">Statut</label>
                    <select name="statut" class="form-control @error('statut') is-invalid @enderror" required>
                        <option value="en attente" {{ $demande->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="complétée" {{ $demande->statut == 'complétée' ? 'selected' : '' }}>Complétée</option>
                    </select>
                    @error('statut')
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
