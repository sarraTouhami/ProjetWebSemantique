@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px">
    <h1>Liste des recommandations</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('recommendations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter une nouvelle recommandation
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Contenu</th>
                    <th>Type</th>
                    <th>Applicable À</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recommendations as $recommendation)
                    <tr>
                        <td>{{ $recommendation->contenu }}</td>
                        <td>{{ $recommendation->type }}</td>
                        <td>{{ $recommendation->applicable_a }}</td>
                        <td>
                            <a href="{{ route('recommendations.edit', $recommendation->id) }}" class="btn btn-sm btn-info mb-2">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ route('recommendations.destroy', $recommendation->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recommandation ?');">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
