@extends('layouts.app')

@section('content')
<div class="p-4 mb-5 " data-wow-delay="0.1s" style="margin-top: 100px;">
    <h1>Modifier le produit alimentaire</h1>

    <form action="{{ route('produitAlimentaire.update', $produitAlimentaire->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Make sure this line is included -->

        <div class="form-group">
            <label for="nom">Nom de l'aliment</label>
            <input type="text" name="nom" id="nom" class="form-control " value="{{  $produitAlimentaire->nom }}" required>
            @error('nom')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
    <label for="categorie">Catégorie</label>
    <select name="categorie" id="categorie" class="form-control" required>
        <option value="" disabled>Select a category</option>
        <option value="fruit" {{ $produitAlimentaire->categorie === 'fruit' ? 'selected' : '' }}>Fruit</option>
        <option value="legume" {{ $produitAlimentaire->categorie === 'legume' ? 'selected' : '' }}>Légume</option>
        <!-- Add more options as needed -->
    </select>
    @error('categorie')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" value="{{ $produitAlimentaire->quantite }}" required>
            @error('quantite')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_peremption">Date de péremption</label>
            <input type="date" name="date_peremption" id="date_peremption" class="form-control" value="{{  $produitAlimentaire->date_peremption }}" required>
            @error('date_peremption')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-outline-primary border-2 py-2 px-4 mt-3 rounded-pill">Mettre à jour le produit</button>
    </form>
</div>
@endsection
