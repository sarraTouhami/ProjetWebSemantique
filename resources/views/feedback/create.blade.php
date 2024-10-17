@extends('layouts.app')

@section('title', 'Add Feedback')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Ajouter un Feedback</h2>
        </div>
    </div>

    <!-- Formulaire d'ajout de feedback -->
    <form action="{{ route('feedbacks.store') }}" method="POST">
        @csrf <!-- Protection CSRF de Laravel -->

        <!-- Bénéficiaire ID -->
        <div class="form-group mb-3">
            <label for="beneficiare_id">Bénéficiaire ID</label>
            <input type="text" name="beneficiare_id" id="beneficiare_id" class="form-control" placeholder="Entrez l'ID du bénéficiaire" required>
        </div>

        <!-- Type de Feedback -->
        <div class="form-group mb-3">
            <label for="type_feedback">Type de Feedback</label>
            <select name="type_feedback" id="type_feedback" class="form-control" required>
                <option value="don">Don</option>
                <option value="evenement">Événement</option>
                <option value="reservation">Réservation</option>
            </select>
        </div>

        <!-- Contenu du Feedback -->
        <div class="form-group mb-3">
            <label for="contenu_feedback">Contenu du Feedback</label>
            <textarea name="contenu_feedback" id="contenu_feedback" class="form-control" placeholder="Entrez votre feedback" rows="5" required></textarea>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary btn-block">Ajouter le Feedback</button>
    </form>
</div>
@endsection
