@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px">
    <h1>Modifier la recommandation</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recommendations.update', $recommendation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="contenu">Contenu</label>
            <textarea name="contenu" class="form-control" required>{{ $recommendation->contenu }}</textarea>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" class="form-control" required>
                <option value="conservation" {{ $recommendation->type == 'conservation' ? 'selected' : '' }}>Conservation</option>
                <option value="gestion des portions" {{ $recommendation->type == 'gestion des portions' ? 'selected' : '' }}>Gestion des portions</option>
            </select>
        </div>
        <div class="form-group">
            <label for="applicable_a">Applicable À</label>
            <select name="applicable_a" class="form-control" required>
                <option value="donateur" {{ $recommendation->applicable_a == 'donateur' ? 'selected' : '' }}>Donateur</option>
                <option value="bénéficiaire" {{ $recommendation->applicable_a == 'bénéficiaire' ? 'selected' : '' }}>Bénéficiaire</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
