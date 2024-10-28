@extends('layouts.app')
<style>
    /* Custom styles for the posts card */
    .custom-card {
        border: 1px solid #e0e0e0;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        background-color: #f9f9f9;
    }

    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        background-color: #fff3e0;
    }

    .card-title {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: #28a745;
    }

    .card-text {
        font-size: 1.1rem;
        color: #333;
    }

    h1 {
        padding-top: 20px;
        color: #333;
    }

    .text-center {
        text-align: center;
    }

    .container {
        padding: 20px;
    }

    .page-padding {
        padding-top: 100px;
    }

    /* Icon color */
    .card-title i {
        color: #28a745;
    }

    /* Type and Creator labels */
    .card-text strong {
        color: #ff9800;
    }

    /* Add button styling */
    .add-button {
        font-size: 1.2rem;
        color: #ffffff;
        background-color: #28a745;
        border: none;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-left: 10px;
        margin-top: 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .add-button:hover {
        background-color: #218838;
    }

    .header-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

@section('content')

<div class="container page-padding">
    <div class="header-container">
        <h1 class="text-center my-4">Liste des Publications</h1>
        <button class="add-button" onclick="window.location.href='{{ route('post.create') }}'">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    @if (empty($results))
    <p class="text-center">Aucune publication.</p>
    @else
    <div class="row justify-content-center">
        @foreach ($results as $post)
        <div class="col-md-8 mb-4">
            <div class="card custom-card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-sticky-note"></i>
                        {{ $post['title']['value'] ?? 'N/A' }}
                    </h5>
                    <p class="card-text">
                        {{ Str::limit($post['contenu']['value'] ?? 'N/A', 100, '...') }}
                    </p>
                    <p class="card-text">
                        <strong><i class="fas fa-tags"></i> Type:</strong>
                        {{ $post['type_de_post']['value'] ?? 'N/A' }}
                    </p>
                    <p class="card-text">
                        <strong><i class="fas fa-user"></i> Createur:</strong>
                        {{ $post['creatorName']['value'] ?? 'N/A' }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection
