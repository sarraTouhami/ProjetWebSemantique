@extends('admin.layouts.app')

@section('title', 'Liste des événements')

@section('content')
<div class="container mt-5">
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des événements</h5>
            <a href="{{ route('admin.events.create') }}" class="btn btn-success">Ajouter un nouvel événement</a>
        </div>
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th class="d-none d-xl-table-cell">Description</th>
                    <th class="d-none d-md-table-cell">Date</th>
                    <th class="d-none d-md-table-cell">Lieu</th>
                    <th class="d-none d-md-table-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td class="d-none d-xl-table-cell">{{ $event->description }}</td>
                        <td class="d-none d-md-table-cell">{{ $event->date }}</td>
                        <td class="d-none d-md-table-cell">{{ $event->location }}</td>
                        <td>
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
