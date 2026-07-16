<?php require 'views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-end mb-4">
    <div>
        <h2 class="fw-bold mb-1">Halo, <?= escape($_SESSION['name']) ?> 👋</h2>
        <p class="text-muted mb-0">Selamat datang di Dashboard Siswa. Mari mulai belajar!</p>
    </div>
    <a href="<?= BASE_URL ?>?page=groups&action=create" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="bi bi-plus-circle me-2"></i>Buat Kelompok Baru</a>
</div>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h5 class="mb-0 fw-bold"><i class="bi bi-collection-fill me-2 text-primary"></i>Kelompok Belajar Saya</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush mt-2">
                    <?php foreach($myGroups as $g): ?>
                        <a href="<?= BASE_URL ?>?page=groups&action=show&id=<?= $g['id'] ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3 mb-2 rounded border">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                    <i class="bi bi-book fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold"><?= escape($g['name']) ?></h6>
                                    <small class="text-muted d-flex align-items-center">
                                        <span class="badge bg-primary rounded-pill px-2 py-1 me-2"><?= escape($g['subject_name']) ?></span> 
                                        <span><i class="bi bi-people-fill me-1 text-secondary"></i> <?= $g['member_count'] ?>/<?= $g['max_members'] ?> Anggota</span>
                                    </small>
                                </div>
                            </div>
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="bi bi-chevron-right text-muted"></i>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    
                    <?php if(empty($myGroups)): ?>
                        <div class="empty-state mt-2">
                            <i class="bi bi-inbox fs-1 mb-3 d-block text-primary opacity-50"></i>
                            <h6 class="fw-bold">Belum Bergabung dengan Kelompok</h6>
                            <p class="small mb-3">Anda belum tergabung di kelompok belajar mana pun. Cari dan bergabunglah dengan teman-teman Anda!</p>
                            <a href="<?= BASE_URL ?>?page=groups" class="btn btn-primary rounded-pill btn-sm px-4">Cari Kelompok</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h5 class="mb-0 fw-bold"><i class="bi bi-calendar-event-fill me-2 text-warning"></i>Jadwal Mendatang</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush mt-2">
                    <?php foreach($upcomingSchedules as $s): ?>
                        <li class="list-group-item p-3 mb-2 rounded border">
                            <div class="d-flex">
                                <div class="me-3">
                                    <div class="bg-warning bg-opacity-10 text-warning rounded text-center p-2" style="min-width: 50px;">
                                        <div class="fs-5 fw-bold lh-1"><?= date('d', strtotime($s['start_time'])) ?></div>
                                        <div class="small fw-semibold mt-1" style="font-size: 0.75rem;"><?= strtoupper(date('M', strtotime($s['start_time']))) ?></div>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-truncate fw-bold" style="max-width: 180px;" title="<?= escape($s['title']) ?>"><?= escape($s['title']) ?></h6>
                                    <div class="small text-muted mb-1 d-flex align-items-center">
                                        <i class="bi bi-clock me-1"></i> <?= date('H:i', strtotime($s['start_time'])) ?> - <?= date('H:i', strtotime($s['end_time'])) ?>
                                    </div>
                                    <div class="small mt-2">
                                        <a href="<?= BASE_URL ?>?page=groups&action=show&id=<?= $s['group_id'] ?>" class="text-decoration-none fw-semibold text-primary">
                                            <i class="bi bi-box-arrow-up-right me-1"></i> <?= escape($s['group_name']) ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    
                    <?php if(empty($upcomingSchedules)): ?>
                        <div class="empty-state mt-2 p-4 text-center">
                            <i class="bi bi-calendar-x fs-2 mb-2 d-block text-warning opacity-50"></i>
                            <h6 class="fw-bold mb-1">Jadwal Kosong</h6>
                            <p class="small text-muted mb-0">Tidak ada jadwal belajar dalam waktu dekat.</p>
                        </div>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>
