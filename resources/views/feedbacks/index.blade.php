@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px">
    <h1>Liste des Feedbacks</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('feedbacks.create') }}" class="btn btn-primary"> <i class="fas fa-plus"></i> Ajouter un nouveau feedback</a>
    </div>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un feedback..." onkeyup="filterFeedbacks()">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID Utilisateur</th>
                    <th>Type de Feedback</th>
                    <th>Contenu du Feedback</th>
                    <th>Date de Création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->user_id }}</td>
                        <td>{{ $feedback->type_feedback }}</td>
                        <td>{{ $feedback->contenu_feedback }}</td>
                        <td>{{ $feedback->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <!-- Bouton Modifier -->
                            <a href="{{ route('feedbacks.edit', $feedback->id) }}" class="btn btn-sm btn-info mb-2">
                                <i class="fas fa-edit"></i> Modifier
                            </a>

                            <!-- Bouton Supprimer avec confirmation -->
                            <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce feedback ?');">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>

                            <!--  bouton pour afficher le feedback -->
                            <a href="{{ route('feedbacks.show', $feedback->id) }}" class="btn btn-sm btn-primary mb-2">
                                <i class="fas fa-eye"></i> Voir Détails
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
function filterFeedbacks() {
    let input = document.getElementById('searchInput');
    let filter = input.value.toLowerCase();
    let table = document.querySelector('table');
    let tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) {
        let tdUserId = tr[i].getElementsByTagName('td')[0];
        let tdTypeFeedback = tr[i].getElementsByTagName('td')[1];
        let tdContent = tr[i].getElementsByTagName('td')[2];
        
        if (tdUserId || tdTypeFeedback || tdContent) {
            let textValue = (tdUserId.textContent || tdUserId.innerText) +
                            (tdTypeFeedback.textContent || tdTypeFeedback.innerText) +
                            (tdContent.textContent || tdContent.innerText);
            if (textValue.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }       
    }
}
</script>
@endsection
