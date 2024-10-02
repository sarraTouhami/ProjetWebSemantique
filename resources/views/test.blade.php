@extends('layouts.app')

@section('title', 'Ajouter un produit alimentaire')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Ajouter un nouveau produit alimentaire</h2>
        </div>
    </div>

    <!-- Formulaire pour ajouter un nouveau produit alimentaire -->
    <form action="{{ route('produits_alimentaires.store') }}" method="POST" enctype="multipart/form-data">
       
        
        <!-- Nom de l'aliment -->
        <div class="form-group mb-3">
            <label for="nomAliment">Nom de l'aliment</label>
            <input type="text" name="nom" id="nomAliment" class="form-control" placeholder="Entrez le nom de l'aliment" required value="{{ old('nom') }}">
            @error('nom')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Catégorie de l'aliment -->
        <div class="form-group mb-3">
            <label for="categorieAliment">Catégorie</label>
            <input type="text" name="categorie" id="categorieAliment" class="form-control" placeholder="Entrez la catégorie de l'aliment" required value="{{ old('categorie') }}">
            @error('categorie')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Quantité disponible -->
        <div class="form-group mb-3">
            <label for="quantiteAliment">Quantité</label>
            <input type="number" name="quantite" id="quantiteAliment" class="form-control" placeholder="Entrez la quantité" required value="{{ old('quantite') }}">
            @error('quantite')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Date de péremption -->
        <div class="form-group mb-3">
            <label for="datePeremptionAliment">Date de péremption</label>
            <input type="date" name="date_peremption" id="datePeremptionAliment" class="form-control" required value="{{ old('date_peremption') }}">
            @error('date_peremption')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary btn-block">Ajouter le produit alimentaire</button>
    </form>
</div>
@endsection
