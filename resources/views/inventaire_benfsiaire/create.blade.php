<!-- resources/views/demandes/create.blade.php -->
@extends('layouts.app')
@section('title', 'Add inventaire ')
@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Créer une nouvelle inventaire</h2>
        </div>
    </div>
    <form action="{{ route('inventaires-beneficiaires.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div  class="form-group">
            <label for="nom_article">Nom de l'article :</label>
            <input type="text" id="nom_article" name="nom_article" value="{{ old('nom_article') }}" class="form-control" required>
        </div>

        <div  class="form-group">
            <label for="quantite">Quantité :</label>
            <input type="number" id="quantite" name="quantite" value="{{ old('quantite') }}" class="form-control" required>
        </div>

        <div  class="form-group">
            <label for="date_peremption">Date de péremption :</label>
            <input type="date" id="date_peremption" name="date_peremption" value="{{ old('date_peremption') }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="localisation">Localisation :</label>
            <input type="text" id="localisation" name="localisation" value="{{ old('localisation') }}" class="form-control" required>
        </div>
        
        
        <button type="submit" class="btn btn-primary">Ajouter l'article</button>
    </form>
</div>
</div>
<a href="{{ route('inventaires-beneficiaires.index') }}">Retour à la liste des articles</a>
@endsection
