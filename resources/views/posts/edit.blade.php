@extends('layouts.app')
@section('title', 'Modifier publication')
@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Modifier la publication</h2>
        </div>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="titre">Titre: </label>
            <input type="text" name="titre" class="form-control" value="{{ $post->titre }}" required>
        </div>
        
        <div class="form-group">
            <label for="contenu">Contenu de publication: </label>
            <textarea name="contenu" class="form-control" rows="5" required>{{ $post->contenu }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="type_post">Type de la publication: </label>
            <select name="type_post" class="form-control" >
                <option value="Evenenement" {{ $post->type_post == 'Evenenement' ? 'selected' : '' }}>Evenenement</option>
                <option value="Question" {{ $post->type_post == 'Question' ? 'selected' : '' }}>Question</option>
                <option value="Blog" {{ $post->type_post == 'Blog' ? 'selected' : '' }}>Blog</option>
            </select>            </div>

        
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
</div>
@endsection
