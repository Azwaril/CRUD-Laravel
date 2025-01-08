<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Tambah Post</h1>

        <!-- Tampilkan error jika validasi gagal -->
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form untuk menambah post -->
        <form action="<?php echo e(route('posts.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo e(old('title')); ?>" required>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" id="slug" name="slug" class="form-control" value="<?php echo e(old('slug')); ?>" required>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" id="user_id" name="user_id" class="form-control" value="<?php echo e(old('user_id')); ?>" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea id="content" name="content" class="form-control" rows="5" required><?php echo e(old('content')); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Slug Generator Script -->
    <script>
        document.getElementById('title').addEventListener('input', function () {
            let slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
            document.getElementById('slug').value = slug;
        });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\crud-posts\resources\views/posts/create.blade.php ENDPATH**/ ?>