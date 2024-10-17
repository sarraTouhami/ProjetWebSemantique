@extends('admin.layouts.app')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Détails du Profil</h1>
        </div>
        
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="User Avatar" class="img-fluid rounded-circle mb-2" style="width: 128px; height: 128px; object-fit: cover;" />
                        <h5 class="card-title mb-0">{{ $user->first_name }} {{ $user->last_name }}</h5>
                        <div class="text-muted mb-2">{{ ucfirst($user->role) }}</div>

                    </div>

                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Informations Personnelles</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><strong>Email :</strong> {{ $user->email }}</li>
                            <li class="mb-1"><strong>Numéro de téléphone :</strong> {{ $user->phone_number }}</li>
                            <li class="mb-1"><strong>Date de naissance :</strong> {{ $user->birthdate ? $user->birthdate->format('d M Y') : 'Non spécifiée' }}</li>
                        </ul>
                    </div>
                    
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Informations Complémentaires</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><strong>Secteur :</strong> {{ ucfirst($user->sector) }}</li>
                            <li class="mb-1"><strong>Association / ONG :</strong> {{ $user->association_name ?? 'N/A' }}</li>
                            <li class="mb-1"><strong>Ville :</strong> {{ $user->city }}</li>
                            <li class="mb-1"><strong>À propos :</strong> {{ $user->bio ?? 'Aucune description disponible' }}</li>
                        </ul>
                    </div>
                    
                    <hr class="my-0" />
                    
                    
                </div>
            </div>

            <div class="col-md-8 col-xl-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Demande</h5>
                    </div>
                    <div class="card-body h-100">
                        <!-- Static data for Demands -->
                        <div class="d-flex align-items-start">
                            <img src="{{ asset('backoffice/img/avatars/avatar-5.jpg') }}" width="36" height="36" class="rounded-circle me-2" alt="User">
                            <div class="flex-grow-1">
                                <small class="float-end text-navy">1h ago</small>
                                <strong>Christina Mason</strong> a fait une demande pour <strong>Vêtements</strong><br />
                                <small class="text-muted">Aujourd'hui 10:30</small><br />
                                <div class="border text-sm text-muted p-2 mt-1">
                                    Besoin de vêtements pour les sans-abris dans la région.
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="d-flex align-items-start">
                            <img src="{{ asset('backoffice/img/avatars/avatar-5.jpg') }}" width="36" height="36" class="rounded-circle me-2" alt="User">
                            <div class="flex-grow-1">
                                <small class="float-end text-navy">3h ago</small>
                                <strong>Christina Mason</strong> a fait une demande pour <strong>Jouets</strong><br />
                                <small class="text-muted">Aujourd'hui 7:15</small><br />
                                <div class="border text-sm text-muted p-2 mt-1">
                                    Demande de jouets pour des enfants dans des foyers d'accueil.
                                </div>
                            </div>
                        </div>
                        <hr />
                        <hr />
                        <h5 class="card-title mb-0">Don</h5>
                        <!-- Static data for Donations -->
                        <div class="d-flex align-items-start">
                            <img src="{{ asset('backoffice/img/avatars/avatar-4.jpg') }}" width="36" height="36" class="rounded-circle me-2" alt="User">
                            <div class="flex-grow-1">
                                <small class="float-end text-navy">5h ago</small>
                                <strong>Christina Mason</strong> a fait un don de <strong>50 €</strong><br />
                                <small class="text-muted">Aujourd'hui 5:30</small><br />
                                <div class="border text-sm text-muted p-2 mt-1">
                                    Don pour les réfugiés en situation de crise alimentaire.
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="d-flex align-items-start">
                            <img src="{{ asset('backoffice/img/avatars/avatar-4.jpg') }}" width="36" height="36" class="rounded-circle me-2" alt="User">
                            <div class="flex-grow-1">
                                <small class="float-end text-navy">1d ago</small>
                                <strong>Christina Mason</strong> a fait un don de <strong>30 €</strong><br />
                                <small class="text-muted">Hier 4:00</small><br />
                                <div class="border text-sm text-muted p-2 mt-1">
                                    Contribution pour la construction d'une école pour enfants.
                                </div>
                            </div>
                        </div>
                        <hr />
                        <hr />
                        <div class="d-grid">
                            <a href="#" class="btn btn-primary">Charger plus</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</main>
@endsection
