@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Modifier le Don</h2>
        </div>
    </div>
    <form action="{{ route('Dons.update', $don->id) }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Laravel CSRF protection -->
        @method('PUT') <!-- Indique que c'est une mise à jour -->

        <div class="form-group mb-3">
            <label for="typeAliment">Type de l'aliment</label>
            <input type="text" name="type_aliment" id="typeAliment" class="form-control" placeholder="Entrer le type de l'aliment" value="{{ $don->type_aliment }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantité" id="quantite" class="form-control" placeholder="Entrer la quantité" value="{{ $don->quantité }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="deadline">Date de préremption</label>
            <input type="date" name="date_peremption" id="deadline" class="form-control" value="{{ $don->date_peremption }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="dateDon">Date du don</label>
            <input type="date" name="date_don" id="dateDon" class="form-control" value="{{ $don->date_don }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="form-control" required>
                <option value="disponible" {{ $don->statut == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="récupéré" {{ $don->statut == 'récupéré' ? 'selected' : '' }}>Récupéré</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Modifier</button>
    </form>
</div>
@endsection
