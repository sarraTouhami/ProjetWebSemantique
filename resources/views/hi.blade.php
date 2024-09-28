{{-- resources/views/welcome.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to RescueFood</title>
    <!-- Add your CSS files here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div class="container">
        <h1>Welcome to the RescueFood Application</h1>

        <p>This is the home page. You can manage your posts from here.</p>

        <a href="{{ route('posts.index') }}" class="btn btn-primary">Manage Posts</a>
    </div>

    <!-- Add your JS files here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
