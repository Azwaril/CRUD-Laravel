<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD</title>
    <!-- Link ke CSS Lokal -->
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
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
        <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-primary mb-3">Tambahkan</a>
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
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($post->id); ?></td>
                            <td><?php echo e($post->title); ?></td>
                            <td><?php echo e($post->slug); ?></td>
                            <td><?php echo e($post->content); ?></td>
                            <td>
                                <!-- Cek apakah gambar ada -->
                                <?php if($post->image && $post->image !== 'Noimage.jpg'): ?>
                                    <img src="<?php echo e(asset('storage/' . $post->image)); ?>" alt="Image" class="img-thumbnail" width="100">
                                <?php else: ?>
                                    <span class="text-muted">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($post->aktif); ?></td>
                            <td><?php echo e($post->status); ?></td>
                            <td>
                                <!-- Tombol Actions -->
                                <a href="<?php echo e(route('posts.show', $post->id)); ?>" class="btn btn-sm btn-info">lihat</a>
                                <a href="<?php echo e(route('posts.edit', $post->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                                <form action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS (Opsional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\crud-posts\resources\views/posts/index.blade.php ENDPATH**/ ?>