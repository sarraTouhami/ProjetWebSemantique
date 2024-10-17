@extends('admin.layouts.app')

@section('title', 'Ajouter une demande')

@section('content')
<div class="container">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Créer une nouvelle demande</h5>
        </div>
        <form action="{{ route('admin.demandes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
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
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Créer la demande</button>
            </div>
        </form>
    </div>
</div>
@endsection
