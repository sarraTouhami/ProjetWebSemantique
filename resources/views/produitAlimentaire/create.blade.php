@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base -->

@section('content')
<div  class="p-4 mb-5 " data-wow-delay="0.1s" style="margin-top: 100px;">
    <h1>Ajouter un produit alimentaire</h1>

    <!-- Formulaire pour ajouter un nouveau produit alimentaire -->
    <form action="{{ route('produitAlimentaire.store') }}" method="POST">
        @csrf
        
        
        <div class="form-group">
            <label for="nom">Nom de l'aliment</label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom de l'aliment" value="{{ old('nom') }}">
            @error('nom')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

      
        <div class="form-group">
    <label for="categorie">Catégorie</label>
    <select name="categorie" id="categorie" class="form-control">
        <option value="">Sélectionnez une catégorie</option>
        <option value="fruit" {{ old('categorie') == 'fruit' ? 'selected' : '' }}>Fruit</option>
        <option value="legume" {{ old('categorie') == 'legume' ? 'selected' : '' }}>Légume</option>
    </select>
    @error('categorie')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


       
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" placeholder="Entrez la quantité" value="{{ old('quantite') }}">
            @error('quantite')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
     
      
        <div class="form-group">
            <label for="date_peremption">Date de péremption</label>
            <input type="date" name="date_peremption" id="date_peremption" class="form-control" value="{{ old('date_peremption') }}">
            @error('date_peremption')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
      
        
        <button type="submit" class="btn btn-outline-primary border-2 py-2 px-4 mt-3  rounded-pill">Ajouter le produit</button>
    </form>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

</div>
@endsection
