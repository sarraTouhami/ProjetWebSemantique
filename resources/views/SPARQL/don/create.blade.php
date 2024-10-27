@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <h1 class="text-center mb-5">Créer un Nouveau Don</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('don.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="type_aliment" class="form-label">Type d'Aliment</label>
            <input type="text" name="type_aliment" class="form-control" id="type_aliment" required>
        </div>

        <div class="mb-3">
            <label for="quantité" class="form-label">Quantité</label>
            <input type="number" name="quantité" class="form-control" id="quantité" required min="1">
        </div>

        <div class="mb-3">
            <label for="date_don" class="form-label">Date du Don</label>
            <input type="date" name="date_don" class="form-control" id="date_don" required>
        </div>

        <div class="mb-3">
            <label for="date_permption" class="form-label">Date de Péremption</label>
            <input type="date" name="date_permption" class="form-control" id="date_permption" required>
        </div>

        <div class="mb-3">
            <label for="statut_don" class="form-label">Statut du Don</label>
            <select name="statut_don" class="form-select" id="statut_don" required>
                <option value="" disabled selected>Choisissez un statut</option>
                <option value="recupere">Récupéré</option>
                <option value="disponible">Disponible</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Créer le Don</button>
        <a href="{{ route('don.search') }}" class="btn btn-secondary">Retourner à la recherche</a>
    </form>
</div>
@endsection
