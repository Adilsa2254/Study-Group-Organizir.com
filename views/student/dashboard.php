<?php require 'views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard Siswa</h2>
    <a href="<?= BASE_URL ?>?page=groups&action=create" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Buat Kelompok Baru</a>
</div>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-collection me-2 text-primary"></i> Kelompok Belajar Saya</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php foreach($myGroups as $g): ?>
                        <a href="<?= BASE_URL ?>?page=groups&action=show&id=<?= $g['id'] ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3">
                            <div>
                                <h6 class="mb-1 fw-bold"><?= escape($g['name']) ?></h6>
                                <small class="text-muted"><i class="bi bi-journal-bookmark me-1"></i> <?= escape($g['subject_name']) ?> &bull; <i class="bi bi-people ms-1 me-1"></i> <?= $g['member_count'] ?>/<?= $g['max_members'] ?></small>
                            </div>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </a>
                    <?php endforeach; ?>
                    <?php if(empty($myGroups)): ?>
                        <li class="list-group-item p-5 text-center text-muted">
                            <i class="bi bi-inbox fs-1 mb-3 d-block text-black-50"></i>
                            <p class="mb-3">Anda belum bergabung dengan kelompok belajar manapun.</p>
                            <a href="<?= BASE_URL ?>?page=groups" class="btn btn-outline-primary">Cari Kelompok</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-calendar-event me-2 text-warning"></i> Jadwal Mendatang</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php foreach($upcomingSchedules as $s): ?>
                        <li class="list-group-item p-3">
                            <h6 class="mb-1 text-truncate fw-bold"><?= escape($s['title']) ?></h6>
                            <div class="small text-muted mb-1">
                                <i class="bi bi-clock me-1"></i> <?= date('d M Y, H:i', strtotime($s['start_time'])) ?>
                            </div>
                            <div class="small text-primary">
                                <a href="<?= BASE_URL ?>?page=groups&action=show&id=<?= $s['group_id'] ?>" class="text-decoration-none">
                                    <i class="bi bi-people me-1"></i> <?= escape($s['group_name']) ?>
                                </a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    <?php if(empty($upcomingSchedules)): ?>
                        <li class="list-group-item p-4 text-center text-muted">
                            Belum ada jadwal dalam waktu dekat.
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>
