@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Détails du Feedback</h2>
        </div>
    </div>

    <div class="d-flex justify-content-center"> <!-- Centrer la carte -->
        <div class="card" style="width: 30rem;"> <!-- Élargir la carte -->
            <!-- Image du feedback -->
            <img src="{{ asset('img/Feedback.png') }}" class="card-img-top" alt="Image Feedback">

            <div class="card-body">
                <h5 class="card-title text-center">Type de Feedback: {{ ucfirst($feedback->type_feedback) }}</h5>
                <p class="card-text">
                    <strong>Contenu du Feedback :</strong><br>
                    {{ $feedback->contenu_feedback }}
                </p>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>User ID :</strong> {{ $feedback->user_id }}</li>
                <li class="list-group-item"><strong>Date :</strong> {{ $feedback->created_at->format('d/m/Y') }}</li>
                <li class="list-group-item"><strong>Type :</strong> {{ ucfirst($feedback->type_feedback) }}</li>
            </ul>

            <div class="card-body text-center"> <!-- Centrer les boutons -->
                <a href="{{ route('feedbacks.index') }}" class="btn btn-primary">Retour à la Liste</a>
            </div>
        </div>
    </div>
</div>

@endsection
