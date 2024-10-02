{{-- resources/views/produits_alimentaires/index.blade.php --}}

@extends('layouts.app') 

@section('title', 'All Products')

@section('content')
    <div  class=" p-4 mb-5 " data-wow-delay="0.1s" style="margin-top: 100px;">
        <h1>Tous les produit</h1>

        <a href="{{ route('produitAlimentaire.create') }}" class="btn btn-outline-primary border-2 py-2 px-4 mb-3 rounded-pill">Ajouter un produit</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($produitAlimentaire->count())
        <div class="row">
    @foreach ($produitAlimentaire as $produit)
        <div class="col-lg-6 col-md-4 col-sm-6 mb-4"> 
            <div class="product-item bg-light overflow-hidden">
                <div class="position-relative">

                   
                </div>
                <div class="text-center p-4">
                    <a class="d-block h5 mb-2" href="{{ route('produitAlimentaire.show', $produit->id) }}">{{ $produit->nom }}</a>
                    <span class="text-body">Catégorie: {{ $produit->categorie }}</span>
                    <br>
                    <span class="text-body">Quantité: {{ $produit->quantite }}</span>
                    <br>
                    <span class="text-body">Date d'expiration: {{ $produit->date_peremption }}</span>
                </div>
                <div class="d-flex border-top">
    <small class="w-50 text-center border-end py-2">
        <a class="text-body" href="{{ route('produitAlimentaire.show', $produit->id) }}">
            <i class="fa fa-eye text-primary me-2"></i>View detail
        </a>
    </small>
    <small class="w-50 text-center border-end py-2">
        <a class="text-body" href="{{ route('produitAlimentaire.edit', $produit->id) }}">
            <i class="fa fa-edit text-warning me-2"></i>Edit
        </a>
    </small>
    <small class="w-50 text-center py-2">
        <form action="{{ route('produitAlimentaire.destroy', $produit->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Tu es sûr?')" title="Delete" style="border-radius: 0.25rem; border: none; padding: 0;">
                <i class="fas fa-trash text-danger me-2"></i> Delete
            </button>
        </form>
    </small>
</div>

               



            </div>
        </div>
    @endforeach
</div>

        @else
            <p>Aucun produit disponible. <a href="{{ route('produitAlimentaire.create') }}">Ajouter un produit maintenant!</a></p>
        @endif
    </div>
@endsection
