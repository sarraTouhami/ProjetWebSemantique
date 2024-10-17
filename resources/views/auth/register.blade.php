@extends('layouts.app')

@section('content')
<section class="vh-100" style="margin-top: 200px;">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img class="w-100" src="{{asset('img/carousel-1.jpg')}}" alt="Image"> <!-- You can change the image for the registration page if needed -->
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <!-- Name input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="name">Name</label>
            <input type="text" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror"
              name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
              placeholder="Enter your name" />

            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
              name="email" value="{{ old('email') }}" required autocomplete="email"
              placeholder="Enter a valid email address" />

            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
              name="password" required autocomplete="new-password"
              placeholder="Enter password" />

            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <!-- Confirm Password input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="password-confirm">Confirm Password</label>
            <input type="password" id="password-confirm" class="form-control form-control-lg"
              name="password_confirmation" required autocomplete="new-password"
              placeholder="Confirm your password" />
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">
              Register
            </button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? 
              <a href="{{ route('login') }}" class="link-danger">Login</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
