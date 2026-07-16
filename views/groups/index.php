<?php require 'views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Eksplorasi Kelompok Belajar</h2>
    <a href="<?= BASE_URL ?>?page=groups&action=create" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Buat Kelompok</a>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body bg-light">
        <form method="GET" action="" class="row g-3">
            <input type="hidden" name="page" value="groups">
            <div class="col-md-5">
                <select name="subject_id" class="form-select">
                    <option value="">Semua Mata Pelajaran</option>
                    <?php foreach($subjects as $s): ?>
                        <option value="<?= $s['id'] ?>" <?= (isset($_GET['subject_id']) && $_GET['subject_id'] == $s['id']) ? 'selected' : '' ?>><?= escape($s['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-5">
                <input type="text" name="q" class="form-control" placeholder="Cari nama kelompok..." value="<?= escape($_GET['q'] ?? '') ?>">
            </div>
            <div class="col-md-2 text-end">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <?php foreach($groups as $g): ?>
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="card-title text-primary fw-bold mb-0"><?= escape($g['name']) ?></h5>
                    <span class="badge bg-primary rounded-pill px-3 py-2"><?= escape($g['subject_name']) ?></span>
                </div>
                <p class="card-text text-muted small mb-3">Dibuat oleh: <?= escape($g['creator_name']) ?></p>
                <p class="card-text"><?= nl2br(escape(substr($g['description'], 0, 100))) ?><?= strlen($g['description']) > 100 ? '...' : '' ?></p>
                
                <div class="mt-auto pt-3 border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small"><i class="bi bi-people-fill me-1"></i> <?= $g['member_count'] ?> / <?= $g['max_members'] ?> Anggota</span>
                        <a href="<?= BASE_URL ?>?page=groups&action=show&id=<?= $g['id'] ?>" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    
    <?php if(empty($groups)): ?>
    <div class="col-12 mt-4">
        <div class="empty-state">
            <i class="bi bi-search fs-1 mb-3 d-block text-primary"></i>
            <h5 class="fw-bold">Tidak ada kelompok belajar ditemukan</h5>
            <p>Coba sesuaikan filter pencarian atau buat kelompok baru untuk mulai belajar.</p>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php require 'views/layouts/footer.php'; ?>
