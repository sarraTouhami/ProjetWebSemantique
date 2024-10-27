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

    /* Search Form Styles */
    .input-group {
        margin-bottom: 20px; /* Space below input group */
    }

    .form-check {
        margin-bottom: 10px; /* Space between checkbox filters */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .user-card {
            margin-bottom: 20px; /* Margin for smaller screens */
        }
    }
</style>
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="text-center mb-5">Liste des Utilisateurs</h1>

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

            <!-- Results Display with Cards -->
            <div class="row">
                @foreach($utilisateurs as $utilisateur)
                @if(!empty($utilisateur['name']['value']) || !empty($utilisateur['email']['value']))
                <div class="col-md-4 mb-4">
                    <div class="card user-card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $utilisateur['name']['value'] ?? 'N/A' }}</h5>
                            <p class="card-text"><strong>Email:</strong> {{ $utilisateur['email']['value'] ?? 'N/A' }}</p>

                            @php
                            $userRole = $utilisateur['type']['value'] ?? null; // Access the type instead of role
                            @endphp

                            <!-- Display Location and Vehicle based on Role -->
                            <p class="card-text"><strong>Localisation:</strong> {{ $utilisateur['location']['value'] ?? 'N/A' }}</p>
                            <p class="card-text"><strong>Détails Véhicule:</strong> {{ $utilisateur['vehicle']['value'] ?? 'N/A' }}</p>
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
@endsection
