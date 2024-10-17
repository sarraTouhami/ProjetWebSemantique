@extends('layouts.app')

@section('content')
<section class="vh-100" style="margin-top: 200px;">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <!-- Smaller image column -->
      <div class="col-md-6 col-lg-4 col-xl-3">
        <img class="w-100" src="{{asset('img/carousel-1.jpg')}}" alt="Image"> <!-- You can change the image for the registration page if needed -->
      </div>
      <div class="col-md-10 col-lg-6 col-xl-6 offset-xl-1">
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <!-- First Name and Last Name inputs -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="first_name">First Name</label>
                <input type="text" id="first_name" class="form-control form-control-lg @error('first_name') is-invalid @enderror"
                  name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus
                  placeholder="Enter your first name" />
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="last_name">Last Name</label>
                <input type="text" id="last_name" class="form-control form-control-lg @error('last_name') is-invalid @enderror"
                  name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name"
                  placeholder="Enter your last name" />
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <!-- Email and Phone Number inputs -->
          <div class="row">
            <div class="col-md-6">
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
            </div>

            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" class="form-control form-control-lg @error('phone_number') is-invalid @enderror"
                  name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number"
                  placeholder="Enter your phone number" />
                @error('phone_number')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <!-- Password and Confirm Password inputs -->
          <div class="row">
            <div class="col-md-6">
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
            </div>

            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="password-confirm">Confirm Password</label>
                <input type="password" id="password-confirm" class="form-control form-control-lg"
                  name="password_confirmation" required autocomplete="new-password"
                  placeholder="Confirm your password" />
              </div>
            </div>
          </div>

          <!-- Birthdate and Role inputs -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="birthdate">Birthdate</label>
                <input type="date" id="birthdate" class="form-control form-control-lg @error('birthdate') is-invalid @enderror"
                  name="birthdate" value="{{ old('birthdate') }}" required autocomplete="birthdate" />
                @error('birthdate')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="role">Role</label>
                <select id="role" class="form-control form-control-lg @error('role') is-invalid @enderror"
                  name="role" required>
                  <option value="" disabled selected>Select a role</option>
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

          <!-- Sector and Association Name inputs -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-outline mb-4">
                <label class="form-label" for="sector">Sector</label>
                <select id="sector" class="form-control form-control-lg @error('sector') is-invalid @enderror"
                  name="sector" required>
                  <option value="" disabled selected>Select a sector</option>
                  <option value="restaurant">Restaurant</option>
                  <option value="grocery_store">Grocery Store</option>
                  <option value="food_bank">Food Bank</option>
                  <option value="food_delivery">Food Delivery</option>
                  <option value="catering">Catering</option>
                  <option value="food_association">Food Association</option>
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
                <label class="form-label" for="association_name">Association Name</label>
                <input type="text" id="association_name" class="form-control form-control-lg @error('association_name') is-invalid @enderror"
                  name="association_name" value="{{ old('association_name') }}" autocomplete="association_name"
                  placeholder="Enter your association name (if applicable)" />
                @error('association_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <!-- City input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="city">City</label>
            <input type="text" id="city" class="form-control form-control-lg @error('city') is-invalid @enderror"
              name="city" value="{{ old('city') }}" autocomplete="city"
              placeholder="Enter your city (optional)" />
            @error('city')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
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
