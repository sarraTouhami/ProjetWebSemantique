{{-- resources/views/posts/index.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <!-- Add your CSS files here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div class="container">
        <h1>All Posts</h1>

        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($posts->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ Str::limit($post->body, 100) }}</td>
                            <td>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No posts available. <a href="{{ route('posts.create') }}">Create one now!</a></p>
        @endif
    </div>

    <!-- Add your JS files here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
