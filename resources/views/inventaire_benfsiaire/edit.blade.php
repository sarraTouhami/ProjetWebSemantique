@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Modifier l'inventaire</h2>
        </div>
    <form action="{{ route('inventaires-beneficiaires.update', $inventaireBeneficiaire->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div  class="form-group">
            <label for="nom_article">Nom de l'article :</label>
            <input type="text" id="nom_article" name="nom_article" value="{{ $inventaireBeneficiaire->nom_article }}}" required>
        </div>

        <div  class="form-group">
            <label for="quantite">Quantité :</label>
            <input type="number" id="quantite" name="quantite" value="{{ $inventaireBeneficiaire->quantite }}" required>
        </div>

        <div  class="form-group">
            <label for="date_peremption">Date de péremption :</label>
            <input type="date" id="date_peremption" name="date_peremption" value="{{$inventaireBeneficiaire->date_peremption }}" required>
        </div>
        <div class="form-group">
            <label for="localisation">Localisation :</label>
            <input type="text" id="localisation" name="localisation" value="{{$inventaireBeneficiaire->localisation }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
</div>
@endsection
