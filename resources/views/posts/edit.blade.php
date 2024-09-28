{{-- resources/views/posts/edit.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <!-- Add your CSS files here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div class="container">
        <h1>Edit Post</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}" required>
            </div>

            <div class="form-group">
                <label for="body">Content</label>
                <textarea name="body" class="form-control" id="body" rows="4" required>{{ $post->body }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Update Post</button>
        </form>
    </div>

    <!-- Add your JS files here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
