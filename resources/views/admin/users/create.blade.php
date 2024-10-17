@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Create New User</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Personal Information Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations personnelles</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="first_name" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                        @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="last_name" class="form-label">Nom de famille</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                        @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="birthdate" class="form-label">Date de naissance</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                        @error('birthdate')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="phone_number" class="form-label">Numéro de téléphone</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        @error('phone_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="city" class="form-label">Ville</label>
                        <input type="text" class="form-control" id="city" name="city">
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="bio" class="form-label">À propos</label>
                        <textarea class="form-control" id="bio" name="bio"></textarea>
                        @error('bio')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Login Credentials Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations de connexion</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role Information Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations sur le rôle</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="donateur">Donateur</option>
                            <option value="beneficiaire">Bénéficiaire</option>
                            <option value="transporteur">Transporteur</option>
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="sector" class="form-label">Secteur</label>
                        <select class="form-control" id="sector" name="sector">
                            <option value="restaurant">Restaurant</option>
                            <option value="grocery_store">Magasin d'alimentation</option>
                            <option value="food_bank">Banque alimentaire</option>
                            <option value="food_delivery">Livraison de nourriture</option>
                            <option value="catering">Traiteur</option>
                            <option value="food_association">Association/ONG liée à l'alimentation</option>
                        </select>
                        @error('sector')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="association_name" class="form-label">Nom de l'organization</label>
                        <input type="text" class="form-control" id="association_name" name="association_name">
                        @error('association_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-4 mb-3">
                        <label for="profile_picture" class="form-label">Photo de profil</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                        @error('profile_picture')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Créer l'utilisateur</button>
    </form>
</div>

@endsection
