<?php require 'views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard Admin</h2>
</div>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card bg-primary text-white h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase text-white-50">Total Users</h6>
                        <h2 class="display-4 fw-bold mb-0"><?= $usersCount ?></h2>
                    </div>
                    <i class="bi bi-people fs-1 text-white-50"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <a class="text-white text-decoration-none stretched-link d-flex justify-content-between" href="<?= BASE_URL ?>?page=users">
                    <span>Kelola Users</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card bg-success text-white h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase text-white-50">Kelompok Belajar</h6>
                        <h2 class="display-4 fw-bold mb-0"><?= $groupsCount ?></h2>
                    </div>
                    <i class="bi bi-collection fs-1 text-white-50"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0 text-white-50">
                <span class="d-flex justify-content-between">
                    <span>Total Grup Aktif</span>
                    <i class="bi bi-check2-circle"></i>
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card bg-warning text-dark h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase text-dark-50" style="opacity: 0.7;">Mata Pelajaran</h6>
                        <h2 class="display-4 fw-bold mb-0"><?= $subjectsCount ?></h2>
                    </div>
                    <i class="bi bi-journal-bookmark fs-1" style="opacity: 0.5;"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <a class="text-dark text-decoration-none stretched-link d-flex justify-content-between" href="<?= BASE_URL ?>?page=subjects">
                    <span>Kelola Mapel</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>
