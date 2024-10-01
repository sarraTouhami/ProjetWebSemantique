<!-- resources/views/demandes/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer une nouvelle demande</h1>
    
    <form action="{{ route('demandes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="beneficiaire_id">ID du bénéficiaire</label>
            <input type="number" name="beneficiaire_id" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="type_aliment">Type d'aliment</label>
            <input type="text" name="type_aliment" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="date_demande">Date de la demande</label>
            <input type="date" name="date_demande" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" class="form-control" required>
                <option value="en attente">En attente</option>
                <option value="complétée">Complétée</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
