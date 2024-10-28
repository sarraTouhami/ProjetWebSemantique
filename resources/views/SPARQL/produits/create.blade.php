@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-4" style="width: 50rem; background-color: #ffffff;">
        <h2 class="text-center mb-4 text-primary">Créer un Nouveau Produit</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('produit.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="product_name" class="form-label">Nom du Produit</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
                @error('product_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="product_type" class="form-label">Type de Produit</label>
                <select class="form-select" id="product_type" name="product_type" required>
                    <option value="" disabled selected>Sélectionnez un type</option>
                    <option value="Produit_Alimentaire">Produit Alimentaire</option>
                    <option value="Produit_Frais">Produit Frais</option>
                </select>
                @error('product_type')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="quantity" class="form-label">Quantité</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                @error('quantity')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="expiration_date" class="form-label">Date de Péremption</label>
                <input type="date" class="form-control" id="expiration_date" name="expiration_date" required>
                @error('expiration_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="category" class="form-label">Catégorie (optionnel)</label>
                <input type="text" class="form-control" id="category" name="category">
                @error('category')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Créer Produit</button>
            </div>
        </form>
    </div>
</div>

@endsection
