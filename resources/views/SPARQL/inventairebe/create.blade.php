@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <h1 class="text-center mb-5 ">Ajouter un Article à l'Inventaire</h1>

    <form action="{{ route('inventairebe.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="produit" class="form-label">Sélectionnez les Produits</label>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sélectionner</th>
                        <th>Nom de l'Aliment</th>
                        <th>Quantité</th>
                        <th>Date de Péremption</th>
                        <th>Catégorie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produits as $produit)
                        <tr>
                            <td>
                                <input type="checkbox" name="produits[]" value="{{ $produit['produit']['value'] }}">
                            </td>
                            <td>{{ $produit['produit']['value'] }}</td>
                            <td>{{ $produit['nom_aliment']['value'] }}</td>
                            <td>{{ $produit['quantite_aliment']['value'] }}</td>
                            <td>{{ $produit['date_permption']['value'] }}</td>
                            <td>{{ $produit['categorie_aliment']['value'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-success">Ajouter à l'Inventaire</button>
    </form>
</div>
@endsection
