@extends('layouts.app')

@section('content')
<section class="vh-100" style="margin-top: 200px;">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <!-- Smaller image column -->
      <div class="col-md-6 col-lg-4 col-xl-3">
        <img class="w-100" src="{{ asset('img/carousel-1.jpg') }}" alt="Image"> 
        <!-- Change this image to fit your design -->
      </div>
      
      <div class="col-md-10 col-lg-6 col-xl-6 offset-xl-1">
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <!-- First Name and Last Name -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="first_name">Prénom</label>
                <input type="text" id="first_name" 
                  class="form-control form-control-lg @error('first_name') is-invalid @enderror"
                  name="first_name" value="{{ old('first_name') }}" required autofocus
                  placeholder="Entrez votre prénom" />
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="last_name">Nom</label>
                <input type="text" id="last_name" 
                  class="form-control form-control-lg @error('last_name') is-invalid @enderror"
                  name="last_name" value="{{ old('last_name') }}" required
                  placeholder="Entrez votre nom" />
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <!-- Email and Phone Number -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" 
                  class="form-control form-control-lg @error('email') is-invalid @enderror"
                  name="email" value="{{ old('email') }}" required
                  placeholder="Entrez une adresse email valide" />
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="phone_number">Numéro de Téléphone</label>
                <input type="text" id="phone_number" 
                  class="form-control form-control-lg @error('phone_number') is-invalid @enderror"
                  name="phone_number" value="{{ old('phone_number') }}" required
                  placeholder="Entrez votre numéro de téléphone" />
                @error('phone_number')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <!-- Password and Confirm Password -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="password">Mot de passe</label>
                <input type="password" id="password" 
                  class="form-control form-control-lg @error('password') is-invalid @enderror"
                  name="password" required placeholder="Entrez un mot de passe" />
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="password-confirm">Confirmer le mot de passe</label>
                <input type="password" id="password-confirm" class="form-control form-control-lg"
                  name="password_confirmation" required placeholder="Confirmez votre mot de passe" />
              </div>
            </div>
          </div>

          <!-- Birthdate and Role -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="birthdate">Date de Naissance</label>
                <input type="date" id="birthdate" 
                  class="form-control form-control-lg @error('birthdate') is-invalid @enderror"
                  name="birthdate" value="{{ old('birthdate') }}" required />
                @error('birthdate')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="role">Rôle</label>
                <select id="role" 
                  class="form-control form-control-lg @error('role') is-invalid @enderror"
                  name="role" required>
                  <option value="" disabled selected>Choisissez un rôle</option>
                  <option value="donateur">Donateur</option>
                  <option value="beneficiaire">Bénéficiaire</option>
                  <option value="transporteur">Transporteur</option>
                </select>
                @error('role')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <!-- Sector and Association Name -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="sector">Secteur</label>
                <select id="sector" 
                  class="form-control form-control-lg @error('sector') is-invalid @enderror"
                  name="sector" required>
                  <option value="" disabled selected>Choisissez un secteur</option>
                  <option value="restaurant">Restaurant</option>
                  <option value="grocery_store">Épicerie</option>
                  <option value="food_store">Magasin alimentaire</option>
                  <option value="logistics">Logistique</option>
                  <option value="healthcare">Santé</option>
                </select>
                @error('sector')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="association_name">Nom de l'Association</label>
                <input type="text" id="association_name" 
                  class="form-control form-control-lg @error('association_name') is-invalid @enderror"
                  name="association_name" value="{{ old('association_name') }}" 
                  placeholder="Entrez le nom de l'association (facultatif)" />
                @error('association_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg">S'inscrire</button>
            <p class="small fw-bold mt-2">Déjà inscrit ? 
              <a href="{{ route('login') }}" class="link-danger">Connexion</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
