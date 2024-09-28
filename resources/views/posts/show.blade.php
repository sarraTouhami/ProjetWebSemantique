{{-- resources/views/posts/show.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <!-- Add your CSS files here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>

        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>

        <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-2">Back to Posts</a>
    </div>

    <!-- Add your JS files here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
