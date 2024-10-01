@extends('layouts.app')

@section('content')
    <h1>List of Reservations</h1>

    <a href="{{ route('reservations.create') }}">Create New Reservation</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Bénéficiaire ID</th>
                <th>Don ID</th>
                <th>Date de réservation</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->beneficiare_id }}</td>
                    <td>{{ $reservation->don_id }}</td>
                    <td>{{ $reservation->date_reservation }}</td>
                    <td>{{ $reservation->statut_reservation }}</td>
                    <td>
                        <a href="{{ route('reservations.show', $reservation->id) }}">Show</a>
                        <a href="{{ route('reservations.edit', $reservation->id) }}">Edit</a>
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
