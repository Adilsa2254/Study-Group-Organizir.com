<nav class="navbar navbar-expand-lg navbar-light sticky-top">
  <div class="container">
    <a class="navbar-brand" href="<?= BASE_URL ?>"><i class="bi bi-journal-bookmark-fill me-2"></i>SGO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <?php if(isset($_SESSION['user_id'])): ?>
            <?php if($_SESSION['role'] === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'dashboard_admin' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=dashboard_admin">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'users' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=users">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'subjects' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=subjects">Mata Pelajaran</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'dashboard_student' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=dashboard_student">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'groups' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=groups">Kelompok Belajar</a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav">
        <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle me-1"></i> <?= escape($_SESSION['name']) ?> (<?= escape(ucfirst($_SESSION['role'])) ?>)
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item text-danger" href="<?= BASE_URL ?>?page=logout"><i class="bi bi-box-arrow-right me-1"></i> Logout</a></li>
                </ul>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link <?= $page == 'login' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page == 'register' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=register">Register</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
