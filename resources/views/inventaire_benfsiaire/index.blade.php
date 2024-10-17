@extends('layouts.app')

@section('content')
   <div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px">
    <h1>Liste des Inventaire </h1>
    <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('inventaires-beneficiaires.create') }}" class="btn btn-primary "> <i class="fas fa-plus"></i>Ajouter une nouvelle article</a>
    </div>
<div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>nom de l'article</th>
                    <th>quantite</th>
                    <th>date de peremption</th>
                    <th>localisation</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach($inventaires as $inventaire)
                    <tr>
                        <td>{{ $inventaire->nom_article }}</td>
                        <td>{{ $inventaire->quantite }}</td>
                        <td>{{ $inventaire->date_peremption }}</td>
                        <td>{{ $inventaire->localisation }} </td>
                        <td>
                            <!-- Bouton Modifier -->
                            <a href="{{ route('inventaires-beneficiaires.edit', $inventaire->id) }}" class="btn btn-sm btn-info mb-2">
                                <i class="fas fa-edit"></i> Modifier
                            </a>

                            <!-- Bouton Supprimer avec confirmation -->
                            <form action="{{ route('inventaires-beneficiaires.destroy', $inventaire->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette inventaire beneficiare ?');">
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