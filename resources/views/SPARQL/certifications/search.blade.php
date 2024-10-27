@extends('layouts.app')

@section('content')
<div class="container">

    @if(isset($results) && count($results['results']['bindings']) > 0)
        <h2>Search Results</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Certification URI</th>
                    <th>Label</th>
                    <th>Description</th>
                    <th>Date Creation</th>
                    <th>Date Validity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results['results']['bindings'] as $certification)
                    <tr>
                        <td>
                            @if(isset($certification['certification']['value']))
                                <a href="{{ $certification['certification']['value'] }}">{{ $certification['certification']['value'] }}</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $certification['label']['value'] ?? 'N/A' }}</td>
                        <td>{{ $certification['description']['value'] ?? 'N/A' }}</td>
                        <td>{{ $certification['date_creation']['value'] ?? 'N/A' }}</td>
                        <td>{{ $certification['date_validite']['value'] ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(isset($results))
        <h2>No Results Found</h2>
    @endif

</div>
@endsection
