@extends('layouts.app')

@section('content')
   <div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px">
    <h1>Liste des publications</h1>
    
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter une nouvelle publication
        </a>
    </div>

    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-4 mb-4 ">
                <div class="card h-100 shadow-sm">
                    @if($post->image_url)
                        <img src="{{ asset($post->image_url) }}" alt="Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('path/to/default-image.jpg') }}" alt="Default Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->titre }}</h5>
                        <p class="card-text">{{ Str::limit($post->contenu, 100) }}</p> <!-- Show a short snippet of content -->
                        <p class="text-muted">Type: {{ $post->type_post }}</p>
                        <p class="text-muted">Utilisateur ID: {{ $post->user_id }}</p>
                        <p class="text-muted">Crée à: {{ $post->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette publication ?');">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        @if($posts->isEmpty())
        <div class="col-12">
            <div class="alert alert-info">
                No posts available.
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
