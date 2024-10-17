<!-- resources/views/demandes/create.blade.php -->
@extends('layouts.app')
@section('title', 'Add demande')
@section('content')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('demandeForm');
        
        form.addEventListener('input', function(event) {
            // ID du bénéficiaire - doit être un nombre valide supérieur à 0
            const beneficiaireId = form.beneficiaire_id;
            if (beneficiaireId.value < 1) {
                document.getElementById('beneficiaire_id_error').textContent = "L'ID du bénéficiaire doit être un nombre positif.";
            } else {
                document.getElementById('beneficiaire_id_error').textContent = "";
            }
            
            // Type d'aliment - seulement des lettres
            const typeAliment = form.type_aliment;
            const typeAlimentPattern = /^[A-Za-z\s]+$/;
            if (!typeAlimentPattern.test(typeAliment.value)) {
                document.getElementById('type_aliment_error').textContent = "Le type d'aliment ne doit contenir que des lettres.";
            } else {
                document.getElementById('type_aliment_error').textContent = "";
            }

            // Quantité - doit être un nombre valide
            const quantite = form.quantite;
            if (quantite.value < 1) {
                document.getElementById('quantite_error').textContent = "La quantité doit être un nombre positif.";
            } else {
                document.getElementById('quantite_error').textContent = "";
            }

            // Date de la demande - vérification basique (déjà gérée par HTML5)
        });

        // Validation complète avant soumission
        form.addEventListener('submit', function(event) {
            let formValid = true;

            if (beneficiaireId.value < 1) {
                formValid = false;
                document.getElementById('beneficiaire_id_error').textContent = "L'ID du bénéficiaire doit être un nombre positif.";
            }

            if (!typeAlimentPattern.test(typeAliment.value)) {
                formValid = false;
                document.getElementById('type_aliment_error').textContent = "Le type d'aliment ne doit contenir que des lettres.";
            }

            if (quantite.value < 1) {
                formValid = false;
                document.getElementById('quantite_error').textContent = "La quantité doit être un nombre positif.";
            }

            if (!formValid) {
                event.preventDefault(); // Empêche la soumission si des champs sont invalides
            }
        });
    });
</script>

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
            <input type="text" name="type_aliment" class="form-control" required pattern="[A-Za-z\s]+" title="Entrez uniquement des lettres">
            <small class="text-danger" id="type_aliment_error"></small>
        </div>
        
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" class="form-control" required min="1" placeholder="Entrez une quantité valide">
            <small class="text-danger" id="quantite_error"></small>
        </div>

        <div class="form-group">
            <label for="date_demande">Date de la demande</label>
            <input type="date" name="date_demande" class="form-control" required>
            <small class="text-danger" id="date_demande_error"></small>
        </div>

        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" class="form-control" required>
                <option value="en attente">En attente</option>
                <option value="complétée">Complétée</option>
            </select>
            <small class="text-danger" id="statut_error"></small>
        </div>
        
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
</div>
@endsection
