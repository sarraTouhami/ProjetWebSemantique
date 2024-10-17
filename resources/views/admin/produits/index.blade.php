@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="card flex-fill">
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>Nom du Produit</th>
                    <th class="d-none d-xl-table-cell">Catégorie</th>
                    <th class="d-none d-xl-table-cell">Quantité</th>
                    <th class="d-none d-xl-table-cell">Date de Péremption</th>
                    <th class="d-none d-xl-table-cell">Type</th>
                    <th class="d-none d-md-table-cell">Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td class="d-none d-xl-table-cell">{{ $produit->categorie }}</td>
                        <td class="d-none d-xl-table-cell">{{ $produit->quantite }}</td>
                        <td class="d-none d-xl-table-cell">
                            {{ \Carbon\Carbon::parse($produit->date_peremption)->format('d/m/Y') }}
                        </td>
                        <td class="d-none d-xl-table-cell">{{ $produit->type }}</td>
                        <td class="d-none d-md-table-cell">
                            <img src="{{ asset($produit->image_url) }}" alt="{{ $produit->nom }}" 
                                 style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                      
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
