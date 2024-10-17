@extends('layouts.app')


@section('content')

<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Ajouter un Produit dans l'inventaire</h2>
        </div>
    </div>
    <form action="{{ route('invertaireDonateurs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3">
        <label for="nomArticle">Nom de l'article</label>
        <input type="text" name="nom_article" id="nomArticle" class="form-control" placeholder="Entrer le nom de l'article" required>
    </div>

    <div class="form-group mb-3">
        <label for="quantite">Quantité</label>
        <input type="number" name="quantité" id="quantite" class="form-control" placeholder="Entrer la quantité" required>
    </div>

    <div class="form-group mb-3">
        <label for="deadline">Date de préremption</label>
        <input type="date" name="date_peremption" id="deadline" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="local">Localisation</label>
        <input type="text" name="localisation" id="local" class="form-control" placeholder="Entrer la localisation" required>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
</form>
</div>

@endsection
