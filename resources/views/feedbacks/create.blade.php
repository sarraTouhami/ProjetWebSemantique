@extends('layouts.app')

@section('title', 'Ajouter un Feedback')

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
        
        <!-- ID Utilisateur -->
        <div class="form-group mb-3">
            <label for="user_id">ID Utilisateur</label>
            <input type="text" name="user_id" id="user_id" class="form-control" placeholder="Entrez l'ID de l'utilisateur" required>
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
            <textarea name="contenu_feedback" id="contenu_feedback" class="form-control" rows="5" placeholder="Entrez le contenu de votre feedback" required></textarea>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary btn-block">Ajouter le Feedback</button>
    </form>
</div>
@endsection
