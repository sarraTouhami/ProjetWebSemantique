@extends('layouts.app')

@section('content')
<div class="container p-4" style="margin-top: 80px">
    <h1 class="h3 mb-4">Modifier le Profil</h1>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Section: Personal Information -->
        <div class="card mb-3 shadow border-0" style="border-radius: 5px;">
            <div class="card-header">
                <h5 class="mb-0">Informations Personnelles</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="first_name">Prénom</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ Auth::user()->first_name }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="last_name">Nom</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="phone_number">Numéro de téléphone</label>
                            <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="profile_picture">Photo de profil</label>
                            <input type="file" id="profile_picture" name="profile_picture" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Additional Information -->
        <div class="card mb-3 shadow border-0" style="border-radius: 5px;">
            <div class="card-header">
                <h5 class="mb-0">Informations Complémentaires</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="bio">À propos</label>
                            <textarea id="bio" name="bio" class="form-control" rows="4">{{ Auth::user()->bio }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="sector">Secteur</label>
                            <select id="sector" name="sector" class="form-control">
                                <option value="restaurant" {{ Auth::user()->sector == 'restaurant' ? 'selected' : '' }}>Restaurant</option>
                                <option value="grocery_store" {{ Auth::user()->sector == 'grocery_store' ? 'selected' : '' }}>Magasin d'alimentation</option>
                                <option value="food_bank" {{ Auth::user()->sector == 'food_bank' ? 'selected' : '' }}>Banque alimentaire</option>
                                <option value="food_delivery" {{ Auth::user()->sector == 'food_delivery' ? 'selected' : '' }}>Livraison de nourriture</option>
                                <option value="catering" {{ Auth::user()->sector == 'catering' ? 'selected' : '' }}>Traiteur</option>
                                <option value="food_association" {{ Auth::user()->sector == 'food_association' ? 'selected' : '' }}>Association/ONG liée à l'alimentation</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="association_name">Association / ONG</label>
                            <input type="text" id="association_name" name="association_name" class="form-control" value="{{ Auth::user()->association_name }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </div>
    </form>
</div>
@endsection
