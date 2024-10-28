@extends('layouts.app')

@section('content')
<style>
    /* Custom styles for the create post page */
    body {
        background-color: #f8f9fa; /* Light background for the body */
    }
    .container {
        margin-top: 120px; /* Top margin for spacing */
        background-color: #fff; /* White background for the form container */
        padding: 30px; /* Padding around the form */
        border-radius: 15px; /* Rounded corners */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }
    h1 {
        color: #28a745; /* Green color for the heading */
        margin-bottom: 30px; /* Spacing below the heading */
    }
    label {
        margin-top: 10px;
        margin-bottom: 10px;
        font-weight: bold; /* Bold labels for better readability */
    }
    .form-control, .form-select {
        border-radius: 10px; /* Rounded corners for inputs */
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1); /* Inner shadow */
    }
    .btn-custom {
        margin-top: 10px;
        background-color: #28a745; /* Custom green button */
        color: #fff; /* White text for button */
        border-radius: 10px; /* Rounded button */
        transition: background-color 0.3s; /* Transition for hover effect */
    }
    .btn-custom:hover {
        background-color: #218838; /* Darker green on hover */
    }
    .error-message {
        color: red; /* Red color for error messages */
    }
    .success-message {
        color: green; /* Green color for success messages */
    }
</style>

<div class="container">
    <h1 class="text-center">Create a New Post</h1>

    @if (session('success'))
    <div class="alert alert-success success-message">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger error-message">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('post.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Titre:</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="contenu">Contenu:</label>
            <textarea name="contenu" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="type_de_post">Type:</label>
            <select name="type_de_post" class="form-select" required>
                <option value="Blog">Blog</option>
                <option value="Article">Article</option>
                <option value="Update">Update</option>
                <option value="Logistics">Logistics</option>
            </select>
        </div>

        <div class="form-group">
            <label for="creator">Createur:</label>
            <select name="creator" class="form-select" required>
                @foreach ($users['results']['bindings'] as $user)
                <option value="{{ $user['user']['value'] }}">
                    {{ $user['nom']['value'] ?? 'Unknown User' }} <!-- Default if nom is missing -->
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-custom btn-block">Create Post</button>
    </form>
</div>
@endsection
