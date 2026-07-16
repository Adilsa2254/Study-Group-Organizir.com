<?php require 'views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Mata Pelajaran</h2>
    <a href="<?= BASE_URL ?>?page=subjects&action=create" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Tambah Mapel</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="30%">Nama Mata Pelajaran</th>
                        <th width="50%">Deskripsi</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($subjects as $s): ?>
                    <tr>
                        <td class="fw-bold"><?= escape($s['name']) ?></td>
                        <td><?= escape($s['description'] ?? '-') ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>?page=subjects&action=edit&id=<?= $s['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="<?= BASE_URL ?>?page=subjects&action=delete" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini? Kelompok belajar terkait juga bisa ikut terhapus!');">
                                <input type="hidden" name="id" value="<?= $s['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($subjects)): ?>
                    <tr>
                        <td colspan="3" class="text-center py-3">Belum ada data mata pelajaran.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>
