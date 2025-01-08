<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">{{ $post->title }}</h1>
        
        <div class="mb-4">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali ke Daftar Posts</a>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- Menampilkan Gambar -->
                <div class="text-center mb-4">
                    @if ($post->image && $post->image !== 'Noimage.jpg')
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Image" class="img-fluid" style="max-width: 100%;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </div>

                <!-- Menampilkan Konten Post -->
                <div class="post-content">
                    <p>{{ $post->content }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
