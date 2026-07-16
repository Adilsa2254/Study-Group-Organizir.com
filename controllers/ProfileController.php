<?php
require_once 'models/User.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '?page=login');
    exit;
}

$userModel = new User($pdo);
$userId = $_SESSION['user_id'];
$currentUser = $userModel->findById($userId);

$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    require 'views/profile/index.php';
}
elseif ($action === 'update') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        
        if (empty($name) || empty($email)) {
            $_SESSION['flash_message'] = "Nama dan Email wajib diisi!";
            $_SESSION['flash_type'] = "danger";
            header('Location: ' . BASE_URL . '?page=profile');
            exit;
        }

        // Handle photo upload if exists
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['profile_photo']['tmp_name'];
            $name_file = $_FILES['profile_photo']['name'];
            $size = $_FILES['profile_photo']['size'];
            $type = $_FILES['profile_photo']['type'];
            
            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
            
            if (in_array($type, $allowed_types)) {
                $ext = pathinfo($name_file, PATHINFO_EXTENSION);
                $new_filename = 'profile_' . $userId . '_' . time() . '.' . $ext;
                $destination = 'uploads/profiles/' . $new_filename;
                
                if (move_uploaded_file($tmp_name, $destination)) {
                    // Delete old photo if exists
                    if (!empty($currentUser['profile_photo']) && file_exists('uploads/profiles/' . $currentUser['profile_photo'])) {
                        unlink('uploads/profiles/' . $currentUser['profile_photo']);
                    }
                    
                    $userModel->updateProfileWithPhoto($userId, $name, $email, $new_filename);
                    
                    $_SESSION['name'] = $name; // Update session name
                    $_SESSION['profile_photo'] = $new_filename; // Update session photo
                    
                    $_SESSION['flash_message'] = "Profil dan foto berhasil diperbarui!";
                    $_SESSION['flash_type'] = "success";
                } else {
                    $_SESSION['flash_message'] = "Gagal mengunggah foto profil.";
                    $_SESSION['flash_type'] = "danger";
                }
            } else {
                $_SESSION['flash_message'] = "Format file tidak didukung. Harap unggah file JPG atau PNG.";
                $_SESSION['flash_type'] = "danger";
            }
        } else {
            // No photo uploaded, just update text info
            $userModel->updateProfile($userId, $name, $email);
            
            $_SESSION['name'] = $name; // Update session name
            
            $_SESSION['flash_message'] = "Profil berhasil diperbarui!";
            $_SESSION['flash_type'] = "success";
        }
        
        header('Location: ' . BASE_URL . '?page=profile');
        exit;
    }
}
?>
