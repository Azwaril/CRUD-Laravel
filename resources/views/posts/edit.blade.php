<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Edit Post</h1>

        <!-- Tampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form untuk edit post -->
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $post->slug) }}" required>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" id="user_id" name="user_id" class="form-control" value="{{ old('user_id', $post->user_id) }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea id="content" name="content" class="form-control" rows="5" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Current Image</label>
                <br>
                <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Change Image</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>

    <script>
        // Slug generator otomatis
        document.getElementById('title').addEventListener('input', function () {
            let slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
            document.getElementById('slug').value = slug;
        });
    </script>
</body>
</html>
