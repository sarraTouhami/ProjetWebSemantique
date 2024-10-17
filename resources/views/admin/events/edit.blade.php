@extends('admin.layouts.app')

@section('title', 'Modifier l\'événement')

@section('content')
<div class="container mt-5">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Modifier l'événement</h5>
        </div>
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">

                <!-- Nom -->
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $event->name }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ $event->description }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date -->
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ $event->date }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Lieu -->
                <div class="form-group">
                    <label for="location">Lieu</label>
                    <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ $event->location }}" required>
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Partenaire -->
                <div class="form-group">
                    <label for="partner_id">Partenaire</label>
                    <select name="partner_id" class="form-control @error('partner_id') is-invalid @enderror" required>
                        @foreach($partners as $partner)
                            <option value="{{ $partner->id }}" {{ $partner->id == $event->partner_id ? 'selected' : '' }}>{{ $partner->name }}</option>
                        @endforeach
                    </select>
                    @error('partner_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
