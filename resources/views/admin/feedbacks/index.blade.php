@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des commentaires</h5>
            <!-- <a href="{{ route('admin.feedbacks.create') }}" class="btn btn-success">Ajouter un Feedback</a> -->
        </div>
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>User_Id</th>
                    <th class="d-none d-xl-table-cell">Type de commentaire</th>
                    <th class="d-none d-xl-table-cell">Contenu du commentaire</th>
                    <th class="d-none d-md-table-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->user_id ?? 'N/A' }}</td> <!-- Vous pouvez remplacer par le nom de l'utilisateur si vous avez une relation -->
                        <td class="d-none d-xl-table-cell">{{ ucfirst($feedback->type_feedback) ?? 'N/A' }}</td> <!-- Utilisation de ucfirst() pour capitaliser le premier caractère -->
                        <td class="d-none d-xl-table-cell">{{ Str::limit($feedback->contenu_feedback, 50) ?? 'N/A' }}</td> <!-- Limite à 50 caractères pour ne pas surcharger la vue -->
                        <td>
                            <a href="{{ route('admin.feedbacks.edit', $feedback->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('admin.feedbacks.destroy', $feedback->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
