<?php require 'views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= isset($group) ? 'Edit Kelompok Belajar' : 'Buat Kelompok Baru' ?></h2>
    <a href="<?= isset($group) ? BASE_URL.'?page=groups&action=show&id='.$group['id'] : BASE_URL.'?page=groups' ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Nama Kelompok</label>
                <input type="text" class="form-control" id="name" name="name" required value="<?= escape($_POST['name'] ?? ($group['name'] ?? '')) ?>" placeholder="Misal: Pejuang UTBK Matematika">
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="subject_id" class="form-label fw-bold">Mata Pelajaran</label>
                    <select class="form-select" id="subject_id" name="subject_id" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        <?php $selected_sub = $_POST['subject_id'] ?? ($group['subject_id'] ?? ''); ?>
                        <?php foreach($subjects as $s): ?>
                            <option value="<?= $s['id'] ?>" <?= $selected_sub == $s['id'] ? 'selected' : '' ?>><?= escape($s['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="max_members" class="form-label fw-bold">Kapasitas Maksimal (Anggota)</label>
                    <input type="number" class="form-control" id="max_members" name="max_members" required min="2" max="100" value="<?= escape($_POST['max_members'] ?? ($group['max_members'] ?? 10)) ?>">
                </div>
            </div>
            
            <div class="mb-4">
                <label for="description" class="form-label fw-bold">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Jelaskan tujuan kelompok ini..."><?= escape($_POST['description'] ?? ($group['description'] ?? '')) ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Kelompok</button>
        </form>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>
