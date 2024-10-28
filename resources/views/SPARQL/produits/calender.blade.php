@extends('layouts.app')

@section('content')
<div class="container ">
    <h2 class="text-center mb-5 mt-2">📅 Calendrier des Produits</h2>
    <div class="text-end mb-4">
                <a href="{{ route('produit.create') }}" class="btn btn-success">Ajouter un produit</a>
            </div>

    @if (count($groupedProducts) > 0)
        <div class="row">
            @foreach ($groupedProducts as $date => $products)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow">
                        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                            </h5>
                            <span class="">
                                {{ count($products) }} produit(s)
                            </span>
                        </div>
                        <div class="card-body">
                            @foreach ($products as $product)
                                <div class="product-item mb-3">
                                    <h6 class="font-weight-bold text-primary">
                                        <i class="fas fa-utensils"></i> {{ $product['nom'] }}
                                    </h6>
                                    <p class="mb-1">
                                        <strong>Quantité :</strong> 
                                        <span class="badge badge-info">{{ $product['quantite'] }}</span>
                                    </p>
                                    <p class="mb-1">
                                        <strong>Catégorie :</strong> 
                                        <span class="badge badge-warning">{{ $product['categorie'] }}</span>
                                    </p>
                                    <hr class="my-2">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> Aucun produit trouvé pour les dates sélectionnées.
        </div>
    @endif
</div>
@endsection
