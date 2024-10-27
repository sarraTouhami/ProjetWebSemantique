@extends('layouts.app')
<style>
    /* Custom styles for the posts card */
    .custom-card {
        border: 1px solid #e0e0e0;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        background-color: #f9f9f9; /* Light background for the card */
    }

    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        background-color: #fff3e0; /* Light orange on hover */
    }

    .card-title {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: #28a745; /* Green color for the title */
    }

    .card-text {
        font-size: 1.1rem;
        color: #333; /* Darker text color */
    }

    h1 {
        padding-top: 20px; /* Top padding for the header */
        color: #333; /* Header color */
    }

    .text-center {
        text-align: center; /* Center text */
    }

    .container {
        padding: 20px; /* Padding for the container */
    }

    /* Icon color */
    .card-title i {
        color: #28a745; /* Green for icons */
    }

    /* Type and Creator labels */
    .card-text strong {
        color: #ff9800; /* Orange for labels */
    }
</style>
@section('content')
<h1 class="text-center my-4">All Posts</h1>

@if (empty($results))
<p class="text-center">No posts found.</p>
@else
<div class="container">
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
                        {{ Str::limit($post['contenu']['value'] ?? 'N/A', 100, '...') }} <!-- Truncate to 10 words -->
                    </p>
                    <p class="card-text">
                        <strong><i class="fas fa-tags"></i> Type:</strong>
                        {{ $post['type_de_post']['value'] ?? 'N/A' }}
                    </p>
                    <p class="card-text">
                        <strong><i class="fas fa-user"></i> Creator:</strong>
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
