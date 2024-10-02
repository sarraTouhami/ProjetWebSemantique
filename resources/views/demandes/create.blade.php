<!-- resources/views/demandes/create.blade.php -->
@extends('layouts.app')
@section('title', 'Add demande')
@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Créer une nouvelle demande</h2>
        </div>
    </div>
    <form action="{{ route('demandes.store') }}" method="POST" enctype="multipart/form-data">
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
</div>
@endsection
