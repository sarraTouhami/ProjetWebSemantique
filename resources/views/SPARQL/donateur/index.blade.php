{{-- resources/views/sparql/donateurs/index.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Donateurs</h1>

    @if (count($donateurs) > 0)
    <table class="table">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($donateurs as $donateur)
        <tr>
            <td>{{ $donateur['name']['value'] ?? 'N/A' }}</td>
            <td>{{ $donateur['email']['value'] ?? 'N/A' }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    <p>Aucun donateur trouvé.</p>
    @endif
</div>
@endsection
