<?php require 'views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card mt-4">
            <div class="card-header bg-transparent border-0 text-center pt-4 pb-0">
                <h3 class="mb-0 text-primary"><i class="bi bi-person-plus-fill me-2"></i>Daftar Akun SGO</h3>
            </div>
            <div class="card-body p-4">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?= escape($error) ?></div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" required value="<?= escape($_POST['name'] ?? '') ?>" placeholder="Nama lengkap Anda">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?= escape($_POST['email'] ?? '') ?>" placeholder="Alamat email">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required minlength="6" placeholder="Minimal 6 karakter">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold">Register</button>
                </form>
                <div class="mt-4 text-center">
                    Sudah punya akun? <a href="<?= BASE_URL ?>?page=login" class="text-decoration-none">Login di sini</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>
