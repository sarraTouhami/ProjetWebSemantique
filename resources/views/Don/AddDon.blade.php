@extends('layouts.app')


@section('content')

<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Ajouter un don</h2>
        </div>
    </div>
    <form action="{{ route('Dons.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3">
        <label for="typeAliment">Type de l'aliment</label>
        <input type="text" name="type_aliment" id="typeAliment" class="form-control" placeholder="Entrer le type de l'aliment" required>
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
        <label for="dateDon">Date du don</label>
        <input type="date" name="date_don" id="dateDon" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="statut">Statut</label>
        <select name="statut" id="statut" class="form-control" required>
            <option value="disponible">Disponible</option>
            <option value="récupéré">Récupéré</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
</form>
</div>

@endsection
