@extends('admin.layouts.app')

@section('title', 'Ajouter une recommandation')

@section('content')
<div class="container">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Créer une nouvelle recommandation</h5>
        </div>
        <form action="{{ route('admin.recommendations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="card-body">
                <div class="form-group">
                    <label for="contenu">Contenu</label>
                    <textarea name="contenu" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" class="form-control" required>
                        <option value="conservation">Conservation</option>
                        <option value="gestion des portions">Gestion des portions</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="applicable_a">Applicable À</label>
                    <select name="applicable_a" class="form-control" required>
                        <option value="donateur">Donateur</option>
                        <option value="bénéficiaire">Bénéficiaire</option>
                    </select>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Créer la recommandation</button>
            </div>
        </form>
    </div>
</div>
@endsection
