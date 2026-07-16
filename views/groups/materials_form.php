<?php require 'views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Upload Materi</h2>
    <a href="<?= BASE_URL ?>?page=groups&action=show&id=<?= $_GET['group_id'] ?? 0 ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Batal</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= escape($error) ?></div>
        <?php endif; ?>
        
        <!-- ENCTYPE is required for file uploads -->
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Judul Materi</label>
                <input type="text" class="form-control" id="title" name="title" required value="<?= escape($_POST['title'] ?? '') ?>" placeholder="Misal: Catatan Bab 1">
            </div>
            
            <div class="mb-3">
                <label for="file" class="form-label fw-bold">Pilih File (PDF, DOCX, JPG, dll)</label>
                <input class="form-control" type="file" id="file" name="file" required>
            </div>
            
            <div class="mb-4">
                <label for="description" class="form-label fw-bold">Deskripsi Tambahan</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?= escape($_POST['description'] ?? '') ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary"><i class="bi bi-upload me-1"></i> Upload Materi</button>
        </form>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>
