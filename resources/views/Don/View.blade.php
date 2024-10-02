@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
<a type="submit" class="btn btn-primary btn-block" href="{{ route('Dons.create') }}">Ajouter</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Date du don</th>
      <th scope="col">Date de préremption</th>
      <th scope="col">Type de l'aliment</th>
      <th scope="col">Quantité</th>
      <th scope="col">Statut</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($don as $item)
    <tr>
        <td>{{ $item->date_don }}</td>
        <td>{{ $item->date_peremption }}</td>
        <td>{{ $item->type_aliment }}</td>
        <td>{{ $item->quantité }}</td>
        <td>{{ $item->statut }}</td>
        <td>
            <a href="{{ route('Dons.show', $item->id) }}" class="btn btn-warning mr-4">voir</a>
            <a href="{{ route('Dons.edit', $item->id) }}" class="btn btn-info mr-4">Modifier</a>
            <form action="{{ route('Dons.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('vous êtes sur?')">Supprimer</button>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

@endsection
