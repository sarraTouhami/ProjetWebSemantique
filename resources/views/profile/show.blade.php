@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="margin-top: 80px">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Mon Profil</h1>
    </div>

    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3 shadow border-0" style="border-radius: 5px;">
                <div class="card-body text-center p-4">
                    <div class="profile-picture" style="position: relative;">
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="User Avatar" class="img-fluid rounded-circle mb-3 shadow" style="width: 128px; height: 128px; object-fit: cover; border: 5px solid #f7f7f9;" />
                    </div>
                    <h5 class="card-title mb-0">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                    <small class="text-muted mb-2">{{ ucfirst(Auth::user()->role) }}</small>

                </div>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm mt-3">Modifier le profil</a>

                <hr class="my-0" />

                <div class="card-body">
                    <div class="list-group">
                        <div class="list-group-item d-flex align-items-center mb-2">
                            <i class="fas fa-envelope text-primary me-3"></i>
                            <span class="text-muted">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="list-group-item d-flex align-items-center mb-2">
                            <i class="fas fa-phone-alt text-primary me-3"></i>
                            <span class="text-muted">{{ Auth::user()->phone_number }}</span>
                        </div>
                        <div class="list-group-item d-flex align-items-center mb-2">
                            <i class="fas fa-birthday-cake text-primary me-3"></i>
                            <span class="text-muted">{{ Auth::user()->birthdate ? Auth::user()->birthdate->format('d M Y') : 'Non spécifiée' }}</span>
                        </div>
                    </div>
                </div>

                <hr class="my-0" />

                <div class="card-body">
                    <div class="list-group">
                        <div class="list-group-item d-flex align-items-center mb-2">
                            <i class="fas fa-briefcase text-primary me-3"></i>
                            <span class="text-muted">{{ ucfirst(Auth::user()->sector) }}</span>
                        </div>
                        <div class="list-group-item d-flex align-items-center mb-2">
                            <i class="fas fa-users text-primary me-3"></i>
                            <span class="text-muted">{{ Auth::user()->association_name ?? 'N/A' }}</span>
                        </div>
                        <div class="list-group-item d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-3"></i>
                            <span class="text-muted">{{ Auth::user()->city }}</span>
                        </div>
                        <div class="list-group-item d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-primary me-3"></i>
                            <span class="text-muted">{{ Auth::user()->bio ?? 'Aucune description disponible' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-xl-9">
            <div class="card mb-3 shadow border-0" style="border-radius: 5px;">
                <div class="card-header">
                    <h5 class="card-title mb-0">Activités Récentes</h5>
                </div>
                <div class="card-body h-100">
                    <!-- Example activity feed -->
                    <div class="d-flex align-items-start mb-3">
                        <img src="{{ asset('path/to/default-avatar.jpg') }}" width="36" height="36" class="rounded-circle me-2 shadow-sm" alt="User">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">1h ago</small>
                            <strong>Nom d'utilisateur</strong> a fait une nouvelle publication<br />
                            <small class="text-muted">Aujourd'hui 10:30</small>
                            <div class="border text-sm text-muted p-2 mt-1 shadow-sm rounded">
                                Voici un aperçu du contenu de la publication.
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="d-flex align-items-start mb-3">
                        <img src="{{ asset('path/to/default-avatar.jpg') }}" width="36" height="36" class="rounded-circle me-2 shadow-sm" alt="User">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">3h ago</small>
                            <strong>Nom d'utilisateur</strong> a ajouté un nouveau commentaire<br />
                            <small class="text-muted">Aujourd'hui 7:15</small>
                            <div class="border text-sm text-muted p-2 mt-1 shadow-sm rounded">
                                Voici un aperçu du contenu du commentaire.
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="d-grid">
                        <a href="#" class="btn btn-primary">Charger plus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
