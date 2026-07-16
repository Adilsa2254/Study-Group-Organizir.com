<?php require 'views/layouts/header.php'; ?>

<div class="row justify-content-center mt-3">
    <div class="col-md-8 col-lg-6">
        <!-- Back Navigation -->
        <div class="mb-4 d-flex align-items-center">
            <a href="<?= BASE_URL ?>?page=<?= $_SESSION['role'] === 'admin' ? 'dashboard_admin' : 'dashboard_student' ?>" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm hover-elevate border d-flex align-items-center">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-4 overflow-hidden mb-5">
            <!-- Header Background Gradient -->
            <div class="position-relative" style="height: 140px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);">
                <!-- Decorative circles -->
                <div class="position-absolute rounded-circle bg-white opacity-10" style="width: 100px; height: 100px; top: -20px; right: 20px;"></div>
                <div class="position-absolute rounded-circle bg-white opacity-10" style="width: 150px; height: 150px; bottom: -50px; left: -20px;"></div>
            </div>
            
            <div class="card-body p-4 p-md-5 pt-0 position-relative">
                <form action="<?= BASE_URL ?>?page=profile&action=update" method="POST" enctype="multipart/form-data">
                    <div class="text-center mb-5" style="margin-top: -65px;">
                        <div class="position-relative d-inline-block">
                            <div class="bg-white rounded-circle p-1 shadow-sm d-inline-block">
                                <?php if (!empty($currentUser['profile_photo']) && file_exists('uploads/profiles/' . $currentUser['profile_photo'])): ?>
                                    <img src="uploads/profiles/<?= escape($currentUser['profile_photo']) ?>" alt="Profile Photo" class="rounded-circle object-fit-cover border border-4 border-white shadow-sm" style="width: 130px; height: 130px;">
                                <?php else: ?>
                                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center border border-4 border-white shadow-sm" style="width: 130px; height: 130px; font-size: 3.5rem; font-weight: 600;">
                                        <?= strtoupper(substr($currentUser['name'], 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <label for="profile_photo" class="position-absolute bg-white text-primary rounded-circle d-flex justify-content-center align-items-center shadow-lg border" style="width: 42px; height: 42px; bottom: 5px; right: 0; cursor: pointer; transition: all 0.2s; z-index: 10;" title="Ganti Foto">
                                <i class="bi bi-camera-fill fs-5"></i>
                            </label>
                            <input type="file" id="profile_photo" name="profile_photo" class="d-none" accept="image/png, image/jpeg, image/jpg">
                        </div>
                        
                        <h3 class="fw-bold mt-3 mb-1"><?= escape($currentUser['name']) ?></h3>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">
                            <i class="bi bi-person-badge me-1"></i> <?= escape(ucfirst($currentUser['role'])) ?>
                        </span>
                        
                        <div class="small text-muted mt-3 fw-medium" id="file-name-display"></div>
                    </div>

                    <h5 class="fw-bold mb-4 text-dark"><i class="bi bi-person-lines-fill me-2 text-primary"></i> Informasi Pribadi</h5>

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control bg-light border-0 shadow-none" id="name" name="name" value="<?= escape($currentUser['name']) ?>" required placeholder="Nama Lengkap">
                        <label for="name" class="text-muted"><i class="bi bi-person me-1"></i> Nama Lengkap</label>
                    </div>

                    <div class="form-floating mb-5">
                        <input type="email" class="form-control bg-light border-0 shadow-none" id="email" name="email" value="<?= escape($currentUser['email']) ?>" required placeholder="Alamat Email">
                        <label for="email" class="text-muted"><i class="bi bi-envelope me-1"></i> Alamat Email</label>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary py-3 rounded-pill fw-bold shadow-lg hover-elevate d-flex justify-content-center align-items-center">
                            <i class="bi bi-save-fill me-2"></i> Simpan Perubahan Profil
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
