@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 text-center">Modifier le Feedback</h2>
            </div>
        </div>
        <form action="{{ route('feedbacks.update', $feedback->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Méthode PUT pour la mise à jour -->

            <!-- Type de Feedback -->
            <div class="form-group">
                <label for="type_feedback">Type de Feedback</label>
                <select name="type_feedback" id="type_feedback" class="form-control" required>
                    <option value="don" {{ $feedback->type_feedback == 'don' ? 'selected' : '' }}>Don</option>
                    <option value="evenement" {{ $feedback->type_feedback == 'evenement' ? 'selected' : '' }}>Événement</option>
                    <option value="reservation" {{ $feedback->type_feedback == 'reservation' ? 'selected' : '' }}>Réservation</option>
                </select>
            </div>

            <!-- Contenu du Feedback -->
            <div class="form-group">
                <label for="contenu_feedback">Contenu du Feedback</label>
                <textarea name="contenu_feedback" id="contenu_feedback" class="form-control" rows="4" required>{{ $feedback->contenu_feedback }}</textarea>
            </div>

            <!-- Bouton de mise à jour -->
            <button type="submit" class="btn btn-primary">Mettre à jour le Feedback</button>
        </form>
    </div>
</div>
@endsection
