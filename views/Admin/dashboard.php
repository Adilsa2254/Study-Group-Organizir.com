<?php require 'views/layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-end mb-4">
    <div>
        <h2 class="fw-bold mb-1">Halo, <?= escape($_SESSION['name']) ?></h2>
        <p class="text-muted mb-0">Selamat datang di Pusat Kendali Administrator. Berikut adalah ringkasan sistem.</p>
    </div>
    <div class="text-muted small">
        <i class="bi bi-clock me-1"></i> <span id="current-time"><?= date('d M Y, H:i') ?></span>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Users Card -->
    <div class="col-md-4">
        <div class="card h-100 border-0 rounded-4 shadow-sm hover-elevate" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <!-- Background decoration -->
                <i class="bi bi-people-fill position-absolute text-white" style="font-size: 8rem; opacity: 0.1; right: -20px; bottom: -20px; transform: rotate(-15deg);"></i>
                
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex justify-content-center align-items-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-person-badge fs-4 text-white"></i>
                    </div>
                    <span class="badge bg-white text-primary rounded-pill">Total Pengguna</span>
                </div>
                
                <h2 class="display-4 fw-bold text-white mb-1"><?= $usersCount ?></h2>
                <p class="text-white-50 mb-0">Akun terdaftar dalam sistem</p>
            </div>
            <a href="<?= BASE_URL ?>?page=users" class="card-footer bg-white bg-opacity-10 border-0 text-white text-decoration-none d-flex justify-content-between align-items-center px-4 py-3 stretched-link">
                <span class="fw-semibold">Kelola Pengguna</span>
                <div class="bg-white text-primary rounded-circle d-flex justify-content-center align-items-center shadow-sm" style="width: 28px; height: 28px;">
                    <i class="bi bi-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>
    
    <!-- Groups Card -->
    <div class="col-md-4">
        <div class="card h-100 border-0 rounded-4 shadow-sm hover-elevate" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <!-- Background decoration -->
                <i class="bi bi-collection-fill position-absolute text-white" style="font-size: 8rem; opacity: 0.1; right: -20px; bottom: -20px; transform: rotate(-15deg);"></i>
                
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex justify-content-center align-items-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-grid-1x2-fill fs-4 text-white"></i>
                    </div>
                    <span class="badge bg-white text-success rounded-pill">Kelompok Aktif</span>
                </div>
                
                <h2 class="display-4 fw-bold text-white mb-1"><?= $groupsCount ?></h2>
                <p class="text-white-50 mb-0">Kelompok belajar yang terbentuk</p>
            </div>
            <div class="card-footer bg-white bg-opacity-10 border-0 text-white d-flex justify-content-between align-items-center px-4 py-3">
                <span class="fw-semibold">Statistik Kelompok</span>
                <i class="bi bi-check-circle-fill text-white opacity-75"></i>
            </div>
        </div>
    </div>
    
    <!-- Subjects Card -->
    <div class="col-md-4">
        <div class="card h-100 border-0 rounded-4 shadow-sm hover-elevate" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <!-- Background decoration -->
                <i class="bi bi-journal-bookmark-fill position-absolute text-white" style="font-size: 8rem; opacity: 0.1; right: -20px; bottom: -20px; transform: rotate(-15deg);"></i>
                
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex justify-content-center align-items-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-book-fill fs-4 text-white"></i>
                    </div>
                    <span class="badge bg-white text-warning rounded-pill">Mata Pelajaran</span>
                </div>
                
                <h2 class="display-4 fw-bold text-white mb-1"><?= $subjectsCount ?></h2>
                <p class="text-white-50 mb-0">Mata pelajaran tersedia</p>
            </div>
            <a href="<?= BASE_URL ?>?page=subjects" class="card-footer bg-white bg-opacity-10 border-0 text-white text-decoration-none d-flex justify-content-between align-items-center px-4 py-3 stretched-link">
                <span class="fw-semibold">Kelola Mapel</span>
                <div class="bg-white text-warning rounded-circle d-flex justify-content-center align-items-center shadow-sm" style="width: 28px; height: 28px;">
                    <i class="bi bi-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>
