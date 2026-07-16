<?php require 'views/layouts/header.php'; ?>

<div class="row justify-content-center mt-4">
    <div class="col-md-7 col-lg-5 col-xl-4">
        <!-- Back Navigation -->
        <div class="mb-3 d-flex justify-content-start">
            <a href="<?= BASE_URL ?>?page=<?= $_SESSION['role'] === 'admin' ? 'dashboard_admin' : 'dashboard_student' ?>" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm hover-elevate border d-flex align-items-center text-muted">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-4 overflow-hidden mb-5">
            <!-- Header Background Gradient -->
            <div class="position-relative" style="height: 110px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);">
                <!-- Decorative circles -->
                <div class="position-absolute rounded-circle bg-white opacity-10" style="width: 80px; height: 80px; top: -15px; right: 15px;"></div>
                <div class="position-absolute rounded-circle bg-white opacity-10" style="width: 120px; height: 120px; bottom: -40px; left: -20px;"></div>
            </div>
            
            <div class="card-body p-4 pt-0 position-relative">
                <form action="<?= BASE_URL ?>?page=profile&action=update" method="POST" enctype="multipart/form-data">
                    <div class="text-center mb-4" style="margin-top: -50px;">
                        <div class="position-relative d-inline-block">
                            <div class="bg-white rounded-circle p-1 shadow-sm d-inline-block">
                                <?php if (!empty($currentUser['profile_photo']) && file_exists('uploads/profiles/' . $currentUser['profile_photo'])): ?>
                                    <img src="uploads/profiles/<?= escape($currentUser['profile_photo']) ?>" alt="Profile Photo" class="rounded-circle object-fit-cover border border-3 border-white shadow-sm" style="width: 100px; height: 100px;">
                                <?php else: ?>
                                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center border border-3 border-white shadow-sm" style="width: 100px; height: 100px; font-size: 2.5rem; font-weight: 600;">
                                        <?= strtoupper(substr($currentUser['name'], 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <label for="profile_photo" class="position-absolute bg-white text-primary rounded-circle d-flex justify-content-center align-items-center shadow-lg border" style="width: 36px; height: 36px; bottom: 5px; right: -5px; cursor: pointer; transition: all 0.2s; z-index: 10;" title="Ganti Foto">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                            <input type="file" id="profile_photo" name="profile_photo" class="d-none" accept="image/png, image/jpeg, image/jpg">
                        </div>
                        
                        <h4 class="fw-bold mt-2 mb-1"><?= escape($currentUser['name']) ?></h4>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill fw-semibold">
                            <i class="bi bi-person-badge me-1"></i> <?= escape(ucfirst($currentUser['role'])) ?>
                        </span>
                        
                        <div class="small text-muted mt-2 fw-medium" id="file-name-display"></div>
                    </div>

                    <h6 class="fw-bold mb-3 text-dark border-bottom pb-2"><i class="bi bi-person-lines-fill me-2 text-primary"></i> Informasi Pribadi</h6>

                    <div class="mb-3">
                        <label for="name" class="form-label small text-muted fw-semibold mb-1"><i class="bi bi-person me-1"></i> Nama Lengkap</label>
                        <input type="text" class="form-control bg-light border-0 shadow-none px-3 py-2" id="name" name="name" value="<?= escape($currentUser['name']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label small text-muted fw-semibold mb-1"><i class="bi bi-envelope me-1"></i> Alamat Email</label>
                        <input type="email" class="form-control bg-light border-0 shadow-none px-3 py-2" id="email" name="email" value="<?= escape($currentUser['email']) ?>" required>
                    </div>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary py-2 rounded-pill fw-bold shadow-sm hover-elevate d-flex justify-content-center align-items-center">
                            <i class="bi bi-save-fill me-2"></i> Simpan Perubahan
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
        const fileNameDisplay = document.getElementById('file-name-display');
        fileNameDisplay.innerHTML = '<span class="badge bg-success bg-opacity-10 text-success p-2 rounded-pill"><i class="bi bi-check-circle-fill me-1"></i> Foto baru dipilih: ' + e.target.files[0].name + '</span>';
        fileNameDisplay.classList.add('animate__animated', 'animate__fadeInUp');
    }
});
</script>

<style>
.form-floating > .form-control:focus, .form-floating > .form-control:not(:placeholder-shown) {
    background-color: #fff !important;
    border: 1px solid var(--primary) !important;
    box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.1) !important;
}
.form-control {
    transition: all 0.3s ease;
}
.hover-elevate {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.hover-elevate:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2) !important;
}
</style>

<?php require 'views/layouts/footer.php'; ?>
