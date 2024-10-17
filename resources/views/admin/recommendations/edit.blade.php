@extends('admin.layouts.app')

@section('title', 'Modifier la recommandation')

@section('content')
<div class="container mt-5">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Modifier la recommandation</h5>
        </div>
        <form action="{{ route('admin.recommendations.update', $recommendation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">

                <!-- Contenu -->
                <div class="form-group">
                    <label for="contenu">Contenu</label>
                    <textarea name="contenu" class="form-control @error('contenu') is-invalid @enderror" required>{{ $recommendation->contenu }}</textarea>
                    @error('contenu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Type -->
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                        <option value="conservation" {{ $recommendation->type == 'conservation' ? 'selected' : '' }}>Conservation</option>
                        <option value="gestion des portions" {{ $recommendation->type == 'gestion des portions' ? 'selected' : '' }}>Gestion des portions</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Applicable À -->
                <div class="form-group">
                    <label for="applicable_a">Applicable À</label>
                    <select name="applicable_a" class="form-control @error('applicable_a') is-invalid @enderror" required>
                        <option value="donateur" {{ $recommendation->applicable_a == 'donateur' ? 'selected' : '' }}>Donateur</option>
                        <option value="bénéficiaire" {{ $recommendation->applicable_a == 'bénéficiaire' ? 'selected' : '' }}>Bénéficiaire</option>
                    </select>
                    @error('applicable_a')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
