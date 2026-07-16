<?php
require_once 'models/User.php';

$userModel = new User($pdo);

// redirect to home if already logged in (except if logging out)
if (isset($_SESSION['user_id']) && $page !== 'logout') {
    header('Location: ' . BASE_URL);
    exit;
}

if ($page === 'login') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $user = $userModel->findByEmail($email);
        
        if ($user && $user['is_active'] && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            
            $_SESSION['flash_message'] = "Login berhasil! Selamat datang, {$user['name']}.";
            $_SESSION['flash_type'] = "success";
            
            header('Location: ' . BASE_URL);
            exit;
        } else {
            if ($user && !$user['is_active']) {
                $error = "Akun Anda dinonaktifkan oleh Admin.";
            } else {
                $error = "Email atau password salah.";
            }
        }
    }
    require 'views/auth/login.php';
} 
elseif ($page === 'register') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($name) || empty($email) || empty($password)) {
            $error = "Semua field wajib diisi.";
        } else {
            if ($userModel->findByEmail($email)) {
                $error = "Email sudah terdaftar.";
            } else {
                if ($userModel->create($name, $email, $password)) {
                    $_SESSION['flash_message'] = "Registrasi berhasil! Silakan login.";
                    $_SESSION['flash_type'] = "success";
                    header('Location: ' . BASE_URL . '?page=login');
                    exit;
                } else {
                    $error = "Terjadi kesalahan saat registrasi.";
                }
            }
        }
    }
    require 'views/auth/register.php';
}
elseif ($page === 'logout') {
    session_destroy();
    session_start();
    $_SESSION['flash_message'] = "Anda berhasil logout.";
    $_SESSION['flash_type'] = "success";
    header('Location: ' . BASE_URL . '?page=login');
    exit;
}
?>
