@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h4 class="mb-4 mt-5">Inventaire des Donateurs</h4>

            <!-- Formulaire de recherche -->
            <form action="{{ route('inventaireDonateur.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search_term" class="form-control" 
                           placeholder="Entrez un mot-clé (Nom, Email, etc.)" 
                           value="{{ request('search_term') }}" required>
                    <button type="submit" class="btn btn-primary px-4">Rechercher</button>
                </div>
            </form>

            <!-- Bouton pour ajouter un donateur -->
            <!-- <div class="text-end mb-4">
                <a  class="btn btn-success">Ajouter un Inventaire Donateur</a>
            </div> -->

            <!-- Bouton pour voir les statistique -->
            <div class="text-end mb-4">
                <a  class="btn btn-secondary">Statistiques</a>
            </div>

            @if($results->count() > 0)
                <!-- Affichage sous forme de cartes -->
                <div class="row">
                    @foreach($results as $donateur)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <strong>Nom de l'article:</strong> {{ $donateur['non_article']['value'] ?? 'N/A' }}
                                    </h5>
                                    <p class="card-text">
                                        <strong>Quantité:</strong> {{ $donateur['quantite_inventaire']['value'] ?? 'N/A' }}<br>
                                        <strong>Localisation:</strong> {{ $donateur['localisation']['value'] ?? 'N/A' }}<br>
                                        <strong>Date de peremption :</strong> {{ $donateur['date_permption']['value'] ?? 'N/A' }}<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Formulaire de suppression -->
                <form action="{{ route('inventaireDonateur.delete') }}" method="POST" class="mt-4">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Choisissez l'attribut à supprimer:</label><br>
                        <input type="radio" id="non_article" name="attribute" value="non_article" required onchange="updatePlaceholder('non_article')">
                        <label for="non_article">Nom de l'article</label><br>
                        <input type="radio" id="quantite_inventaire" name="attribute" value="quantite_inventaire" onchange="updatePlaceholder('quantite_inventaire')">
                        <label for="quantite_inventaire">Quantité</label><br>
                        <input type="radio" id="localisation" name="attribute" value="localisation" onchange="updatePlaceholder('localisation')">
                        <label for="localisation">Localisation</label><br>
                        <input type="radio" id="date_permption" name="attribute" value="date_permption" onchange="updatePlaceholder('date_permption')">
                        <label for="date_permption">Date de peremption</label>
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
            case 'quantite_inventaire':
                input.placeholder = 'Entrez la quantité à supprimer';
                break;
            case 'localisation':
                input.placeholder = 'Entrez la localisation à supprimer';
                break;
            case 'non_article':
                input.placeholder = 'Entrez le nom de l\'article à supprimer';
                break;
            case 'date_permption':
                input.placeholder = 'Entrez la date de peremption à supprimer';
                break;
            default:
                input.placeholder = 'Entrez la valeur à supprimer';
        }
    }
</script>
@endsection
