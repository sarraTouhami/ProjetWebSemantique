<!-- resources/views/demandes/create.blade.php -->
@extends('layouts.app')
@section('title', 'Ajouter publication')
@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Créer une nouvelle publication</h2>
        </div>
    </div>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="titre">Titre: </label>
            <input type="text" name="titre" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="contenu">Contenu de publication: </label>
            <textarea name="contenu" class="form-control" rows="5" required></textarea>
                </div>
        
        <div class="form-group">
            <label for="type_post">Type de la publication: </label>
            <select name="type_post" class="form-control" >
                <option value="Evenenement">Evenenement</option>
                <option value="Question">Question</option>
                <option value="Blog">Blog</option>
            </select>        
        </div>

        <div class="form-group">
            <label for="image_url">An image: </label>
            <input type="file" name="image_url" class="form-control" accept="image/*">
        </div>
        
        
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
</div>
@endsection
