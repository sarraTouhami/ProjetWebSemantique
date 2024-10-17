@extends('admin.layouts.app')

@section('title', 'Modifier le Feedback')

@section('content')
<div class="container mt-5">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Modifier le Feedback</h5>
        </div>
        <form action="{{ route('admin.feedbacks.update', $feedback->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">

                <!-- User ID -->
                <div class="form-group">
                    <label for="user_id">ID de l'utilisateur</label>
                    <input type="number" name="user_id" class="form-control @error('user_id') is-invalid @enderror" value="{{ $feedback->user_id }}" required>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Type de Feedback -->
                <div class="form-group">
                    <label for="type_feedback">Type de Feedback</label>
                    <select name="type_feedback" class="form-control @error('type_feedback') is-invalid @enderror" required>
                        <option value="don" {{ $feedback->type_feedback == 'don' ? 'selected' : '' }}>Don</option>
                        <option value="evenement" {{ $feedback->type_feedback == 'evenement' ? 'selected' : '' }}>Événement</option>
                        <option value="reservation" {{ $feedback->type_feedback == 'reservation' ? 'selected' : '' }}>Réservation</option>
                    </select>
                    @error('type_feedback')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contenu du Feedback -->
                <div class="form-group">
                    <label for="contenu_feedback">Contenu du Feedback</label>
                    <textarea name="contenu_feedback" class="form-control @error('contenu_feedback') is-invalid @enderror" rows="4" required>{{ $feedback->contenu_feedback }}</textarea>
                    @error('contenu_feedback')
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
