@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Ajouter un Article à l'Inventaire</h1>

    <form action="{{ route('inventaire.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom_article" class="form-label">Nom de l'Article</label>
            <input type="text" class="form-control" id="nom_article" name="nom_article" required>
        </div>
        <div class="mb-3">
            <label for="quantite_inventaire" class="form-label">Quantité</label>
            <input type="number" class="form-control" id="quantite_inventaire" name="quantite_inventaire" required>
        </div>
        <div class="mb-3">
            <label for="date_peremption" class="form-label">Date de Péremption</label>
            <input type="date" class="form-control" id="date_peremption" name="date_peremption" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>

        <button type="submit" class="btn btn-success">Ajouter l'Article</button>
    </form>
</div>
@endsection
