@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px">
    <h1>Modifier l'événement</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" class="form-control" value="{{ $event->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ $event->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $event->date }}" required>
        </div>
        <div class="form-group">
            <label for="location">Lieu</label>
            <input type="text" name="location" class="form-control" value="{{ $event->location }}" required>
        </div>
        <div class="form-group">
            <label for="partner_id">Partenaire</label>
            <select name="partner_id" class="form-control" required>
                @foreach($partners as $partner)
                    <option value="{{ $partner->id }}" {{ $partner->id == $event->partner_id ? 'selected' : '' }}>{{ $partner->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
