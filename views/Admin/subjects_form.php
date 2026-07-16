<?php require 'views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= isset($subject) ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran' ?></h2>
    <a href="<?= BASE_URL ?>?page=subjects" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Nama Mata Pelajaran</label>
                <input type="text" class="form-control" id="name" name="name" required value="<?= escape($_POST['name'] ?? ($subject['name'] ?? '')) ?>">
            </div>
            
            <div class="mb-4">
                <label for="description" class="form-label fw-bold">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= escape($_POST['description'] ?? ($subject['description'] ?? '')) ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
        </form>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>
