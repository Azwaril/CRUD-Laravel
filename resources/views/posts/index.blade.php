<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD</title>
    <!-- Link ke CSS Lokal -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS untuk memastikan teks di tabel center-aligned */
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">POSTS</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Tambahkan</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>judul</th>
                        <th>Slug</th>
                        <th>konten</th>
                        <th>gambar</th>
                        <th>Aktif</th>
                        <th>Status</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->content }}</td>
                            <td>
                                <!-- Cek apakah gambar ada -->
                                @if ($post->image && $post->image !== 'Noimage.jpg')
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Image" class="img-thumbnail" width="100">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $post->aktif }}</td>
                            <td>{{ $post->status }}</td>
                            <td>
                                <!-- Tombol Actions -->
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-info">lihat</a>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS (Opsional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
