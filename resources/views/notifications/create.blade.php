<!-- resources/views/demandes/create.blade.php -->
@extends('layouts.app')
@section('title', 'Ajouter notification')
@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Créer une nouvelle notification</h2>
        </div>
    </div>
    <form action="{{ route('notifications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="titre">Titre: </label>
            <input type="text" name="titre" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="message">Contenu de notification: </label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
                </div>
        
        <div class="form-group">
            <label for="type">Type de la notification: </label>
            <select name="type" class="form-control" >
                <option value="Demande">Demande</option>
                <option value="Don">Don</option>
                <option value="Commentaire">Commentaire</option>
                <option value="Transport">Transport</option>
                <option value="Feedback">Feedback</option>
            </select>        
        </div>
        <div class="form-group">
            <label for="est_vu">Marque comme vu</label>
            <input type="checkbox" name="est_vu" value="1">
        </div>
        
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
</div>
@endsection
