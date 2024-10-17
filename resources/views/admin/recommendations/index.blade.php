@extends('admin.layouts.app')

@section('title', 'Liste des recommandations')

@section('content')
<div class="container mt-5">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des recommandations</h5>
            <a href="{{ route('admin.recommendations.create') }}" class="btn btn-success">Ajouter une nouvelle recommandation</a>
        </div>
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>Contenu</th>
                    <th class="d-none d-xl-table-cell">Type</th>
                    <th class="d-none d-md-table-cell">Applicable À</th>
                    <th class="d-none d-md-table-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recommendations as $recommendation)
                    <tr>
                        <td>{{ $recommendation->contenu }}</td>
                        <td class="d-none d-xl-table-cell">{{ $recommendation->type }}</td>
                        <td class="d-none d-md-table-cell">{{ $recommendation->applicable_a }}</td>
                        <td>
                            <a href="{{ route('admin.recommendations.edit', $recommendation->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('admin.recommendations.destroy', $recommendation->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recommandation ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
