@extends('layouts.app')

@section('content')
<div class="p-4 mb-5" data-wow-delay="0.1s" style="margin-top: 100px;">
    <h1 class=" text-center">Modifier le produit</h1>

 
    <form action="{{ route('produitAlimentaire.update', $produitAlimentaire->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom de l'aliment" value="{{ old('nom', $produitAlimentaire->nom) }}">
            @error('nom')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="type">Type :</label>
            <select name="type" id="type" class="form-control">
                <option value="">Sélectionnez un type</option>
                <option value="alimentaire" {{ old('type', $produitAlimentaire->type) == 'alimentaire' ? 'selected' : '' }}>Alimentaire</option>
                <option value="frais" {{ old('type', $produitAlimentaire->type) == 'frais' ? 'selected' : '' }}>Frais</option>
            </select>
            @error('type')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group" id="categorie-group" style="{{ $produitAlimentaire->type == 'frais' ? 'display: block;' : 'display: none;' }}">
            <label for="categorie">Catégorie :</label>
            <select name="categorie" id="categorie" class="form-control">
                <option value="">Sélectionnez une catégorie</option>
                <option value="fruit" {{ old('categorie', $produitAlimentaire->categorie) == 'fruit' ? 'selected' : '' }}>Fruit</option>
                <option value="legume" {{ old('categorie', $produitAlimentaire->categorie) == 'legume' ? 'selected' : '' }}>Légume</option>
            </select>
            @error('categorie')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantite">Quantité :</label>
            <input type="number" name="quantite" id="quantite" class="form-control" placeholder="Entrez la quantité" value="{{ old('quantite', $produitAlimentaire->quantite) }}">
            @error('quantite')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_peremption">Date de péremption :</label>
            <input type="date" name="date_peremption" id="date_peremption" class="form-control" value="{{ old('date_peremption', $produitAlimentaire->date_peremption) }}">
            @error('date_peremption')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="image_url">Image :</label>
            <input type="file" name="image_url" class="form-control" accept="image/*">
            @if($produitAlimentaire->image_url)
                <div class="mt-2">
                    <img src="{{ asset($produitAlimentaire->image_url) }}" alt="{{ $produitAlimentaire->nom }}" class="img-fluid" >
                </div>
            @endif
        </div>
        
        <button type="submit" class="btn btn-outline-primary border-2 py-2 px-4 mt-3 rounded-pill">Mettre à jour le produit</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const categorieGroup = document.getElementById('categorie-group');

        typeSelect.addEventListener('change', function() {
            if (this.value === 'frais') {
                categorieGroup.style.display = 'block';
            } else {
                categorieGroup.style.display = 'none'; 
                document.getElementById('categorie').value = '';
            }
        });
    });
</script>
@endsection
