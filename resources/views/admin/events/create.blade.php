@extends('admin.layouts.app')

@section('title', 'Ajouter un événement')

@section('content')
<div class="container">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Créer un nouvel événement</h5>
        </div>
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="location">Lieu</label>
                    <input type="text" name="location" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="partner_id">Partenaire</label>
                    <select name="partner_id" class="form-control" required>
                        @foreach($partners as $partner)
                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Créer l'événement</button>
            </div>
        </form>
    </div>
</div>
@endsection
