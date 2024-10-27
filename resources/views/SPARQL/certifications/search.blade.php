<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Certifications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Recherche de Certifications</h1>

    <!-- Search form -->
    <form action="{{ route('certification.search') }}" method="GET" class="my-4">
        <div class="input-group">
            <input type="text" name="search_term" class="form-control" placeholder="Entrez un mot-clé" required>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>

    @if($results->count() > 0)
        <h2>Résultats de la recherche</h2>
        <table class="table table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Certification URI</th>
                    <th>Label</th>
                    <th>Description</th>
                    <th>Date de création</th>
                    <th>Date de validité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $certification)
                    <tr>
                        <td>
                            <a href="{{ $certification['certification']['value'] ?? '#' }}" target="_blank">
                                {{ $certification['certification']['value'] ?? 'Lien non disponible' }}
                            </a>
                        </td>
                        <td>{{ $certification['label']['value'] ?? 'N/A' }}</td>
                        <td>{{ $certification['description']['value'] ?? 'N/A' }}</td>
                        <td>{{ $certification['date_creation']['value'] ?? 'N/A' }}</td>
                        <td>{{ $certification['date_validite']['value'] ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $results->links() }}
        </div>
    @else
        <h2>Aucun résultat trouvé</h2>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
