@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="card flex-fill">
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th class="d-none d-xl-table-cell">Date du don</th>
                    <th class="d-none d-xl-table-cell">Date de préremption</th>
                    <th class="d-none d-xl-table-cell">Type de l'aliment</th>
                    <th class="d-none d-xl-table-cell">Quantité</th>
                    <th class="d-none d-md-table-cell">Statut</th>
                    <th class="d-none d-md-table-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($don as $item)
                    <tr>
                        <td class="d-none d-xl-table-cell">
                            {{ \Carbon\Carbon::parse($item->date_don)->format('d/m/Y') }}
                        </td>
                        <td class="d-none d-xl-table-cell">
                            {{ \Carbon\Carbon::parse($item->date_peremption)->format('d/m/Y') }}
                        </td>
                        <td class="d-none d-xl-table-cell">{{ $item->type_aliment }}</td>
                        <td class="d-none d-xl-table-cell">{{ $item->quantité }}</td>
                        <td class="d-none d-xl-table-cell">{{ $item->statut }}</td>
                      
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
