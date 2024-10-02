@extends('layouts.app')

@section('title', 'Modifier la notification')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 text-center">Modifier la notification</h2>
            </div>
        </div>

        <form action="{{ route('notifications.update', $notification->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="titre">Titre:</label>
                <input type="text" name="titre" class="form-control" value="{{ $notification->titre }}" required>
            </div>
            
            <div class="form-group">
                <label for="message">Contenu de notification:</label>
                <textarea name="message" class="form-control" rows="5" required>{{ $notification->message }}</textarea>
            </div>

            <div class="form-group">
                <label for="type">Type de la notification:</label>
                <select name="type" class="form-control">
                    <option value="Demande" {{ $notification->type == 'Demande' ? 'selected' : '' }}>Demande</option>
                    <option value="Don" {{ $notification->type == 'Don' ? 'selected' : '' }}>Don</option>
                    <option value="Commentaire" {{ $notification->type == 'Commentaire' ? 'selected' : '' }}>Commentaire</option>
                    <option value="Transport" {{ $notification->type == 'Transport' ? 'selected' : '' }}>Transport</option>
                    <option value="Feedback" {{ $notification->type == 'Feedback' ? 'selected' : '' }}>Feedback</option>
                </select>        
            </div>

            <div class="form-group">
                <label for="est_vu">Marquer comme vu:</label>
                <input type="checkbox" name="est_vu" value="1" {{ $notification->est_vu ? 'checked' : '' }}>
            </div>
            
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection
