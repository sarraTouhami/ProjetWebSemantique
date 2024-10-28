{{-- resources/views/sparql/evenemets/create.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Ajouter un Événement</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form for Adding Event -->
    <form action="{{ route('evenemets.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Nom de l'Événement</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lieu</label>
            <input type="text" name="location" class="form-control" id="location" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" id="date" required>
        </div>

        <div class="mb-3">
            <label for="partner_id" class="form-label">ID du Partenaire</label>
            <input type="text" name="partner_id" class="form-control" id="partner_id" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Ajouter Événement</button>
        <a href="{{ route('evenemets.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </form>
</div>
@endsection
