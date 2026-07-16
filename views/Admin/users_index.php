<?php require 'views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Users</h2>
    <a href="<?= BASE_URL ?>?page=users&action=create" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Tambah User</a>
</div>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $u): ?>
                    <tr>
                        <td><?= escape($u['name']) ?></td>
                        <td><?= escape($u['email']) ?></td>
                        <td>
                            <?php if($u['role'] == 'admin'): ?>
                                <span class="badge bg-danger">Admin</span>
                            <?php elseif($u['role'] == 'mentor'): ?>
                                <span class="badge bg-info">Mentor</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Student</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($u['is_active']): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-dark">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d M Y, H:i', strtotime($u['created_at'])) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>?page=users&action=edit&id=<?= $u['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <?php if($u['id'] != $_SESSION['user_id']): ?>
                            <form action="<?= BASE_URL ?>?page=users&action=delete" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($users)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-3">Belum ada data user.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>
