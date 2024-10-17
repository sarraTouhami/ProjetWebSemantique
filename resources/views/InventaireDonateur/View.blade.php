@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
<a type="submit" class="btn btn-primary btn-block" href="{{ route('invertaireDonateurs.create') }}">Ajouter</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nom de l'article</th>
      <th scope="col">Quantité</th>
      <th scope="col">Date de préremption</th>
      <th scope="col">Localisation</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($invDonateur as $item)
    <tr>
        <td>{{ $item->nom_article }}</td>
        <td>{{ $item->quantité }}</td>
        <td>{{ $item->date_peremption }}</td>
        <td>{{ $item->localisation }}</td>
        <td>
            <a href="{{ route('invertaireDonateurs.show', $item->id) }}" class="btn btn-warning mr-4">voir</a>
            <a href="{{ route('invertaireDonateurs.edit', $item->id) }}" class="btn btn-info mr-4">Modifier</a>
            <form action="{{ route('invertaireDonateurs.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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
