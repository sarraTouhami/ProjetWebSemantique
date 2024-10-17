@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Modifier l'Article</h2>
        </div>
    </div>
    <form action="{{ route('invertaireDonateurs.update', $invDonateur->id) }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Laravel CSRF protection -->
        @method('PUT') <!-- Indique que c'est une mise à jour -->

        <div class="form-group mb-3">
            <label for="nomArticle">Nom de l'article</label>
            <input type="text" name="nom_article" id="nomArticle" class="form-control" placeholder="Entrer le nom de l'article" value="{{ $invDonateur->nom_article }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantité" id="quantite" class="form-control" placeholder="Entrer la quantité" value="{{ $invDonateur->quantité }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="deadline">Date de préremption</label>
            <input type="date" name="date_peremption" id="deadline" class="form-control" value="{{ $invDonateur->date_peremption }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="local">Localisation</label>
            <input type="text" name="localisation" id="local" class="form-control" placeholder="Entrer la localisation" value="{{ $invDonateur->localisation }}" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Modifier</button>
    </form>
</div>
@endsection
