@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Détails du Don</h2>
        </div>
    </div>

    <div class="card">
        <div class="card-header text-center">
            <h4>{{ $don->type_aliment }}</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Date du Don :</strong>
                <span class="float-right">{{ $don->date_don }}</span>
            </div>
            <div class="mb-3">
                <strong>Date de Préremption :</strong>
                <span class="float-right">{{ $don->date_peremption }}</span>
            </div>
            <div class="mb-3">
                <strong>Quantité :</strong>
                <span class="float-right">{{ $don->quantité }} unités</span>
            </div>
            <div class="mb-3">
                <strong>Statut :</strong>
                <span class="float-right">{{ ucfirst($don->statut) }}</span>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('Dons.index') }}" class="btn btn-primary">Retour à la Liste des Dons</a>
        </div>
    </div>
</div>
@endsection
