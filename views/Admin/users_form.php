<?php require 'views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= isset($user) ? 'Edit User' : 'Tambah User' ?></h2>
    <a href="<?= BASE_URL ?>?page=users" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= escape($error) ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" required value="<?= escape($_POST['name'] ?? ($user['name'] ?? '')) ?>">
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?= escape($_POST['email'] ?? ($user['email'] ?? '')) ?>">
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password <?= isset($user) ? '<small class="text-muted fw-normal">(Kosongkan jika tidak ingin diubah)</small>' : '' ?></label>
                <input type="password" class="form-control" id="password" name="password" <?= isset($user) ? '' : 'required' ?> minlength="6">
            </div>
            
            <div class="mb-3">
                <label for="role" class="form-label fw-bold">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <?php $role = $_POST['role'] ?? ($user['role'] ?? 'student'); ?>
                    <option value="student" <?= $role === 'student' ? 'selected' : '' ?>>Student</option>
                    <option value="mentor" <?= $role === 'mentor' ? 'selected' : '' ?>>Mentor</option>
                    <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            
            <?php if(isset($user)): ?>
            <div class="mb-4 form-check form-switch">
                <?php $is_active = $_POST['is_active'] ?? ($user['is_active'] ?? 1); ?>
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?= $is_active ? 'checked' : '' ?>>
                <label class="form-check-label" for="is_active">Status Akun Aktif</label>
            </div>
            <?php endif; ?>
            
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
        </form>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>
