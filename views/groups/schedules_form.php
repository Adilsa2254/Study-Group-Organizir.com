<?php require 'views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= isset($schedule) ? 'Edit Jadwal' : 'Buat Jadwal Baru' ?></h2>
    <a href="<?= BASE_URL ?>?page=groups&action=show&id=<?= $_GET['group_id'] ?? ($schedule['group_id'] ?? 0) ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Batal</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Judul Sesi Belajar</label>
                <input type="text" class="form-control" id="title" name="title" required value="<?= escape($_POST['title'] ?? ($schedule['title'] ?? '')) ?>">
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_time" class="form-label fw-bold">Waktu Mulai</label>
                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" required value="<?= escape($_POST['start_time'] ?? ($schedule['start_time'] ?? '')) ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_time" class="form-label fw-bold">Waktu Selesai</label>
                    <input type="datetime-local" class="form-control" id="end_time" name="end_time" required value="<?= escape($_POST['end_time'] ?? ($schedule['end_time'] ?? '')) ?>">
                </div>
            </div>
            
            <div class="mb-3">
                <label for="location" class="form-label fw-bold">Lokasi (Opsional)</label>
                <input type="text" class="form-control" id="location" name="location" value="<?= escape($_POST['location'] ?? ($schedule['location'] ?? '')) ?>" placeholder="Misal: Perpus Pusat">
            </div>
            
            <div class="mb-3">
                <label for="meeting_link" class="form-label fw-bold">Link Video Call (Opsional)</label>
                <input type="url" class="form-control" id="meeting_link" name="meeting_link" value="<?= escape($_POST['meeting_link'] ?? ($schedule['meeting_link'] ?? '')) ?>" placeholder="https://meet.google.com/xxx-xxxx-xxx">
            </div>
            
            <div class="mb-4">
                <label for="description" class="form-label fw-bold">Catatan / Deskripsi Singkat</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= escape($_POST['description'] ?? ($schedule['description'] ?? '')) ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Jadwal</button>
        </form>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>
