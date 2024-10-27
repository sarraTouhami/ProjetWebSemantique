@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h4 class="mb-4 mt-5">Recherche de Dons</h4>

            <!-- Formulaire de recherche -->
            <form action="{{ route('don.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search_term" class="form-control" 
                           placeholder="Entrez un mot-clé (Statut, Type, etc.)" 
                           value="{{ request('search_term') }}" required>
                    <button type="submit" class="btn btn-primary px-4">Rechercher</button>
                </div>
            </form>

            <!-- Bouton pour ajouter un don -->
            <div class="text-end mb-4">
                <a href="{{ route('don.create') }}" class="btn btn-success">Ajouter un Don</a>
            </div>

            @if($results->count() > 0)
                <!-- Affichage sous forme de cartes -->
                <div class="row">
                    @foreach($results as $donation)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <strong>Type d'Aliment:</strong> {{ $donation['type_aliment']['value'] ?? 'N/A' }}
                                    </h5>
                                    <p class="card-text">
                                        <strong>Statut du Don:</strong> {{ $donation['statut_don']['value'] ?? 'N/A' }}<br>
                                        <strong>Quantité:</strong> {{ $donation['quantité']['value'] ?? 'N/A' }}<br>
                                        <strong>Date de Péremption:</strong> {{ $donation['date_permption']['value'] ?? 'N/A' }}<br>
                                        <strong>Date du Don:</strong> {{ $donation['date_don']['value'] ?? 'N/A' }}<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Formulaire de suppression -->
                <form action="{{ route('don.delete') }}" method="POST" class="mt-4">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Choisissez l'attribut à supprimer:</label><br>
                        <input type="radio" id="type_aliment" name="attribute" value="type_aliment" required onchange="updatePlaceholder('type_aliment')">
                        <label for="type_aliment">Type d'Aliment</label><br>
                        <input type="radio" id="quantité" name="attribute" value="quantité" onchange="updatePlaceholder('quantité')">
                        <label for="quantité">Quantité</label><br>
                        <input type="radio" id="date_don" name="attribute" value="date_don" onchange="updatePlaceholder('date_don')">
                        <label for="date_don">Date de Don</label><br>
                        <input type="radio" id="date_permption" name="attribute" value="date_permption" onchange="updatePlaceholder('date_permption')">
                        <label for="date_permption">Date de Péremption</label><br>
                        <input type="radio" id="statut_don" name="attribute" value="statut_don" onchange="updatePlaceholder('statut_don')">
                        <label for="statut_don">Statut du Don</label>
                    </div>

                    <div class="input-group">
                        <input type="text" name="value" id="valueInput" class="form-control" 
                               placeholder="Entrez la valeur à supprimer" required>
                        <button type="submit" class="btn btn-danger px-4">Supprimer</button>
                    </div>
                </form>

                <!-- Liens de pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $results->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="alert alert-warning text-center mt-5" role="alert">
                    <h4>Aucun résultat trouvé.</h4>
                    <p>Veuillez réessayer avec un autre mot-clé.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Fonction pour mettre à jour le placeholder de l'input en fonction de l'attribut sélectionné
    function updatePlaceholder(attribute) {
        const input = document.getElementById('valueInput');
        switch (attribute) {
            case 'type_aliment':
                input.placeholder = 'Entrez le type d\'aliment à supprimer';
                break;
            case 'quantité':
                input.placeholder = 'Entrez la quantité à supprimer';
                break;
            case 'date_don':
                input.placeholder = 'Entrez la date du don à supprimer';
                break;
            case 'date_permption':
                input.placeholder = 'Entrez la date de péremption à supprimer';
                break;
            case 'statut_don':
                input.placeholder = 'Entrez le statut du don à supprimer';
                break;
            default:
                input.placeholder = 'Entrez la valeur à supprimer';
        }
    }
</script>
@endsection
