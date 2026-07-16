<?php require 'views/layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="<?= BASE_URL ?>?page=<?= $_SESSION['role'] === 'admin' ? 'dashboard_admin' : 'dashboard_student' ?>" class="back-link"><i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard</a>
    <h2 class="fw-bold mb-0">Profil Saya</h2>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <form action="<?= BASE_URL ?>?page=profile&action=update" method="POST" enctype="multipart/form-data">
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block mb-3">
                            <?php if (!empty($currentUser['profile_photo']) && file_exists('uploads/profiles/' . $currentUser['profile_photo'])): ?>
                                <img src="uploads/profiles/<?= escape($currentUser['profile_photo']) ?>" alt="Profile Photo" class="rounded-circle object-fit-cover shadow-sm border border-3 border-white" style="width: 150px; height: 150px;">
                            <?php else: ?>
                                <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center shadow-sm border border-3 border-white mx-auto" style="width: 150px; height: 150px; font-size: 4rem;">
                                    <?= strtoupper(substr($currentUser['name'], 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                            
                            <label for="profile_photo" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex justify-content-center align-items-center cursor-pointer shadow" style="width: 40px; height: 40px; cursor: pointer; transition: all 0.2s;" title="Ganti Foto">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                            <input type="file" id="profile_photo" name="profile_photo" class="d-none" accept="image/png, image/jpeg, image/jpg">
                        </div>
                        <h4 class="fw-bold"><?= escape($currentUser['name']) ?></h4>
                        <p class="text-muted"><?= escape(ucfirst($currentUser['role'])) ?></p>
                        
                        <div class="small text-muted mt-2" id="file-name-display"></div>
                    </div>

                    <hr class="mb-4">

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= escape($currentUser['name']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= escape($currentUser['email']) ?>" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary py-2 rounded-pill fw-bold shadow-sm">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('profile_photo').addEventListener('change', function(e) {
    if (e.target.files.length > 0) {
        document.getElementById('file-name-display').innerHTML = '<i class="bi bi-check-circle-fill text-success me-1"></i> File dipilih: ' + e.target.files[0].name;
    }
});
</script>

<?php require 'views/layouts/footer.php'; ?>
