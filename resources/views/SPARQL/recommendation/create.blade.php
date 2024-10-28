@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Ajouter une Recommandation</h1>

    <form action="{{ route('recommendation.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="contenu" class="form-label">Contenu</label>
            <input type="text" name="contenu" id="contenu" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="type_Recommendation" class="form-label">Type de Recommandation</label>
            <input type="text" name="type_Recommendation" id="type_Recommendation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="{{ route('recommendation.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
