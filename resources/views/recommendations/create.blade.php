@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px">
    <h1>Ajouter une nouvelle recommandation</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recommendations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
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
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
