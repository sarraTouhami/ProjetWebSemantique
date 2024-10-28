@extends('layouts.app')
<!-- Add Font Awesome CDN in your layout's <head> if not already included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    /* User Card Styles */
    .user-card {
        border: 1px solid #007bff; /* Border color */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        transition: transform 0.2s; /* Animation on hover */
    }

    .user-card:hover {
        transform: translateY(-5px); /* Lift effect on hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Darker shadow on hover */
    }

    .card-title {
        font-size: 1.5rem; /* Increase title font size */
        color: #343a40; /* Dark text color */
        margin-bottom: 0.5rem; /* Space below title */
    }

    .card-text {
        font-size: 1rem; /* Standardize font size */
        color: #6c757d; /* Muted text color */
    }

    .card-body {
        padding: 1.5rem; /* Increase padding */
    }

    .card-body p {
        margin-bottom: 0.5rem; /* Space between paragraphs */
    }

    /* Role Icons */
    .role-icon {
        margin-right: 5px; /* Space between icon and text */
    }

    /* Sidebar Styles */
    .sidebar {
        border-right: 1px solid #dee2e6; /* Border for the sidebar */
        padding-right: 20px;
        margin-right: 10px; /* Space between sidebar and content */
        padding-top: 20px; /* Add top padding for sidebar */
    }

    /* Page Padding */
    .page-padding {
        padding-top: 100px; /* Increase top padding for the entire page */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .user-card {
            margin-bottom: 20px; /* Margin for smaller screens */
        }
        .sidebar {
            border-right: none; /* Remove border on smaller screens */
            padding-right: 0; /* Remove padding on smaller screens */
        }
    }

    /* Two cards per row on medium screens and up */
    @media (min-width: 768px) {
        .card-col {
            flex: 0 0 50%; /* Two cards per row */
            max-width: 50%; /* Two cards per row */
        }
    }
</style>

@section('content')
<div class="container page-padding">
    <div class="row justify-content-center">
        <div class="col-md-10 d-flex">
            <!-- Sidebar for Search and Filters -->
            <div class="sidebar col-md-4 mb-4"> <!-- Increased size of sidebar -->
                <h5>Rechercher des Utilisateurs</h5>
                <!-- Search Form with Input and Checkbox Filters -->
                <form action="{{ route('utilisateur.search') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <!-- Input field for keyword search -->
                        <input type="text" name="search_term" class="form-control"
                               placeholder="Rechercher par nom ou email"
                               value="{{ $searchTerm }}">
                        <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
                    </div>
                    <div class="mt-3">
                        <h5>Filtrer par Rôle :</h5>
                        <!-- Checkbox filters for roles -->
                        @foreach($roles as $role)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="role[]" value="{{ $role }}"
                                   id="role_{{ $role }}"
                                   {{ in_array($role, $selectedRoles) ? 'checked' : '' }}>
                            <label class="form-check-label" for="role_{{ $role }}">
                                <i class="role-icon {{ $role === 'Transporteur' ? 'fas fa-shuttle-van' : ($role === 'Bénéficiaire' ? 'fas fa-user' : 'fas fa-gift') }}"></i>
                                {{ ucfirst($role) }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </form>
            </div>

            <!-- Results Display with Cards -->
            <div class="col-md-8"> <!-- Adjusted column size for results -->
                <h1 class="text-center mb-5">Liste des Utilisateurs</h1>
                <div class="row">
                    @foreach($utilisateurs as $utilisateur)
                    @if(!empty($utilisateur['name']['value']) || !empty($utilisateur['email']['value']))
                    <div class="col-md-6 mb-4 card-col"> <!-- Two cards per row -->
                        <div class="card user-card">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between align-items-center">
                                    {{ $utilisateur['name']['value'] ?? 'N/A' }}
                                    <form action="{{ route('utilisateur.delete') }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE') <!-- This indicates the method should be treated as DELETE -->
                                        <input type="hidden" name="individualUri" value="{{ $utilisateur['individual']['value'] }}">
                                        <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </h5>
                                <p class="card-text"><strong>Email:</strong> {{ $utilisateur['email']['value'] ?? 'N/A' }}</p>

                                <!-- Additional Details Here -->
                                <p class="card-text"><strong>Localisation:</strong> {{ $utilisateur['location']['value'] ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Détails Véhicule:</strong> {{ $utilisateur['vehicle']['value'] ?? 'N/A' }}</p>

                                @if(isset($utilisateur['donCount']['value']))
                                <h6 class="mt-3">Dons Associés</h6>
                                <p class="card-text"><strong>Nombre de Dons:</strong> {{ $utilisateur['donCount']['value'] }}</p>
                                @endif

                            </div>
                        </div>
                    </div>

                    @endif
                    @endforeach
                </div>

                @if (count($utilisateurs) === 0)
                <p>Aucun utilisateur trouvé.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete(individualUri) {
        console.log("logs", individualUri)

        if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
            console.log("Fetching from:", "{{ route('utilisateur.delete') }}");
            fetch("{{ route('utilisateur.delete') }}", {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ individualUri: individualUri })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reload the page or redirect to update the list
                        location.reload();
                    } else {
                        alert('Erreur: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue lors de la suppression de l\'utilisateur.');
                });
        }
    }
</script>
@endsection
