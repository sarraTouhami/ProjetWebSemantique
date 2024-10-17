@extends('layouts.app')

@section('content')
<section class="vh-100" style="margin-top: 200px;">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img class="w-100" src="{{asset('img/carousel-1.jpg')}}" alt="Image"> <!-- Vous pouvez changer l'image pour la page d'inscription si nécessaire -->
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <!-- Champ Nom -->
          <div class="form-outline mb-4">
            <label class="form-label" for="name">Nom</label>
            <input type="text" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror"
              name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
              placeholder="Entrez votre nom" />

            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <!-- Champ Email -->
          <div class="form-outline mb-4">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
              name="email" value="{{ old('email') }}" required autocomplete="email"
              placeholder="Entrez une adresse email valide" />

            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <!-- Champ Mot de passe -->
          <div class="form-outline mb-4">
            <label class="form-label" for="password">Mot de passe</label>
            <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
              name="password" required autocomplete="new-password"
              placeholder="Entrez un mot de passe" />

            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <!-- Champ Confirmation du mot de passe -->
          <div class="form-outline mb-4">
            <label class="form-label" for="password-confirm">Confirmez le mot de passe</label>
            <input type="password" id="password-confirm" class="form-control form-control-lg"
              name="password_confirmation" required autocomplete="new-password"
              placeholder="Confirmez votre mot de passe" />
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">
              S'inscrire
            </button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Vous avez déjà un compte ? 
              <a href="{{ route('login') }}" class="link-danger">Se connecter</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
