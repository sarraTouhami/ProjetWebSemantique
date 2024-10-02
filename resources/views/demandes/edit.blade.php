<!-- resources/views/demandes/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Modifier la demande</h2>
        </div>
    <form action="{{ route('demandes.update', $demande->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="beneficiaire_id">ID du bénéficiaire</label>
            <input type="number" name="beneficiaire_id" class="form-control" value="{{ $demande->beneficiaire_id }}" required>
        </div>
        
        <div class="form-group">
            <label for="type_aliment">Type d'aliment</label>
            <input type="text" name="type_aliment" class="form-control" value="{{ $demande->type_aliment }}" required>
        </div>
        
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" class="form-control" value="{{ $demande->quantite }}" required>
        </div>

        <div class="form-group">
            <label for="date_demande">Date de la demande</label>
            <input type="date" name="date_demande" class="form-control" value="{{ $demande->date_demande }}" required>
        </div>

        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" class="form-control" required>
                <option value="en attente" {{ $demande->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
                <option value="complétée" {{ $demande->statut == 'complétée' ? 'selected' : '' }}>Complétée</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
</div>
@endsection
