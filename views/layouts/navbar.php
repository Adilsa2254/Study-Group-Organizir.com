<nav class="navbar navbar-expand-lg navbar-light sticky-top py-3 bg-white shadow-sm">
  <div class="container">
    <!-- Brand Logo -->
    <a class="navbar-brand d-flex align-items-center fw-bold fs-4" href="<?= BASE_URL ?>" style="letter-spacing: -0.5px;">
        <div class="bg-primary bg-gradient text-white rounded-3 me-2 d-flex justify-content-center align-items-center shadow-sm" style="width: 40px; height: 40px;">
            <i class="bi bi-journal-bookmark-fill fs-5"></i>
        </div>
        <span class="text-primary">Study<span class="text-dark">Group</span></span>
    </a>
    
    <button class="navbar-toggler border-0 shadow-none px-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="bi bi-list fs-1 text-primary"></i>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto ms-lg-4">
        <?php if(isset($_SESSION['user_id'])): ?>
            <?php if($_SESSION['role'] === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'dashboard_admin' ? 'active fw-bold text-primary bg-primary bg-opacity-10' : '' ?> rounded-pill px-3 mx-1 transition-all" href="<?= BASE_URL ?>?page=dashboard_admin"><i class="bi bi-grid-1x2-fill me-1"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'users' ? 'active fw-bold text-primary bg-primary bg-opacity-10' : '' ?> rounded-pill px-3 mx-1 transition-all" href="<?= BASE_URL ?>?page=users"><i class="bi bi-people-fill me-1"></i> Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'subjects' ? 'active fw-bold text-primary bg-primary bg-opacity-10' : '' ?> rounded-pill px-3 mx-1 transition-all" href="<?= BASE_URL ?>?page=subjects"><i class="bi bi-book-half me-1"></i> Mata Pelajaran</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'dashboard_student' ? 'active fw-bold text-primary bg-primary bg-opacity-10' : '' ?> rounded-pill px-3 mx-1 transition-all" href="<?= BASE_URL ?>?page=dashboard_student"><i class="bi bi-house-door-fill me-1"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'groups' ? 'active fw-bold text-primary bg-primary bg-opacity-10' : '' ?> rounded-pill px-3 mx-1 transition-all" href="<?= BASE_URL ?>?page=groups"><i class="bi bi-collection-fill me-1"></i> Kelompok Belajar</a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
      </ul>
      
      <ul class="navbar-nav align-items-lg-center">
        <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center p-1 border rounded-pill shadow-sm" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding-right: 1rem !important;">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px;">
                        <?= strtoupper(substr($_SESSION['name'], 0, 1)) ?>
                    </div>
                    <span class="fw-semibold text-dark me-1"><?= escape(explode(' ', trim($_SESSION['name']))[0]) ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-2 rounded-3" aria-labelledby="navbarDropdown">
                    <li class="px-3 py-2 border-bottom mb-1">
                        <div class="fw-bold"><?= escape($_SESSION['name']) ?></div>
                        <div class="text-muted small"><?= escape(ucfirst($_SESSION['role'])) ?></div>
                    </li>
                    <li><a class="dropdown-item text-danger fw-semibold py-2" href="<?= BASE_URL ?>?page=logout"><i class="bi bi-box-arrow-right me-2"></i> Keluar</a></li>
                </ul>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link fw-semibold px-3 <?= $page == 'login' ? 'text-primary' : '' ?>" href="<?= BASE_URL ?>?page=login">Masuk</a>
            </li>
            <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                <a class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm" href="<?= BASE_URL ?>?page=register">Daftar Sekarang</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
