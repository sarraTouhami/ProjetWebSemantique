{{-- resources/views/posts/create.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
    <!-- Add your CSS files here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div class="container">
        <h1>Create New Post</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" required>
            </div>

            <div class="form-group">
                <label for="body">Content</label>
                <textarea name="body" class="form-control" id="body" rows="4" placeholder="Enter content" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Create Post</button>
        </form>
    </div>

    <!-- Add your JS files here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
