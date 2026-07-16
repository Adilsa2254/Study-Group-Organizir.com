<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ' . BASE_URL);
    exit;
}

require_once 'models/User.php';
$userModel = new User($pdo);
$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    $users = $userModel->getAll();
    require 'views/admin/users_index.php';
} 
elseif ($action === 'create') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'student';
        
        if ($userModel->findByEmail($email)) {
            $error = "Email sudah terdaftar.";
        } else {
            $userModel->create($name, $email, $password, $role);
            $_SESSION['flash_message'] = "User berhasil ditambahkan.";
            $_SESSION['flash_type'] = "success";
            header('Location: ' . BASE_URL . '?page=users');
            exit;
        }
    }
    require 'views/admin/users_form.php';
}
elseif ($action === 'edit') {
    $id = $_GET['id'] ?? 0;
    $user = $userModel->findById($id);
    if (!$user) {
        header('Location: ' . BASE_URL . '?page=users');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? ''; // kosong jika tidak diubah
        $role = $_POST['role'] ?? 'student';
        $is_active = isset($_POST['is_active']) ? 1 : 0;
        
        $existing = $userModel->findByEmail($email);
        if ($existing && $existing['id'] != $id) {
            $error = "Email sudah dipakai user lain.";
        } else {
            if (!empty($password)) {
                $userModel->updateWithPassword($id, $name, $email, $password, $role, $is_active);
            } else {
                $userModel->update($id, $name, $email, $role, $is_active);
            }
            $_SESSION['flash_message'] = "User berhasil diupdate.";
            $_SESSION['flash_type'] = "success";
            header('Location: ' . BASE_URL . '?page=users');
            exit;
        }
    }
    require 'views/admin/users_form.php';
}
elseif ($action === 'delete') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        if ($id != $_SESSION['user_id']) {
            $userModel->delete($id);
            $_SESSION['flash_message'] = "User berhasil dihapus.";
            $_SESSION['flash_type'] = "success";
        } else {
            $_SESSION['flash_message'] = "Tidak dapat menghapus akun Anda sendiri.";
            $_SESSION['flash_type'] = "danger";
        }
    }
    header('Location: ' . BASE_URL . '?page=users');
    exit;
}
?>
