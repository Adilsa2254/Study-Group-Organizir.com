<?php require 'views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card mt-5">
            <div class="card-header bg-transparent border-0 text-center pt-4 pb-0">
                <h3 class="mb-0 text-primary"><i class="bi bi-box-arrow-in-right me-2"></i>Login SGO</h3>
            </div>
            <div class="card-body p-4">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?= escape($error) ?></div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?= escape($_POST['email'] ?? '') ?>" placeholder="Masukkan email">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold">Login</button>
                </form>
                <div class="mt-4 text-center">
                    Belum punya akun? <a href="<?= BASE_URL ?>?page=register" class="text-decoration-none">Daftar di sini</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'views/layouts/footer.php'; ?>
