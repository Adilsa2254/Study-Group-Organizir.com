<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL);
    exit;
}

require_once 'models/Material.php';
require_once 'models/StudyGroup.php';

$materialModel = new Material($pdo);
$groupModel = new StudyGroup($pdo);
$action = $_GET['action'] ?? 'index';

if ($action === 'create') {
    $group_id = $_GET['group_id'] ?? 0;
    
    $group = $groupModel->findById($group_id);
    if (!$group) {
        header('Location: ' . BASE_URL . '?page=groups');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['file']['tmp_name'];
            $orig_name = basename($_FILES['file']['name']);
            $file_type = $_FILES['file']['type'];
            
            if (!is_dir(UPLOAD_PATH)) {
                mkdir(UPLOAD_PATH, 0777, true);
            }
            
            $file_name = $group_id . '_' . time() . '_' . preg_replace("/[^a-zA-Z0-9.-]/", "_", $orig_name);
            $destination = UPLOAD_PATH . $file_name;
            
            if (move_uploaded_file($tmp_name, $destination)) {
                $materialModel->create($group_id, $_SESSION['user_id'], $title, $description, $file_name, $file_type);
                $_SESSION['flash_message'] = "Materi berhasil diunggah.";
                $_SESSION['flash_type'] = "success";
                header('Location: ' . BASE_URL . '?page=groups&action=show&id=' . $group_id);
                exit;
            } else {
                $error = "Gagal mengupload file.";
            }
        } else {
            $error = "Pilih file untuk diupload atau file melebihi batas ukuran (Cek error code PHP: " . $_FILES['file']['error'] . ").";
        }
    }
    require 'views/groups/materials_form.php';
}
elseif ($action === 'delete') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        $group_id = $_POST['group_id'] ?? 0;
        
        $material = $materialModel->findById($id);
        $group = $groupModel->findById($group_id);
        
        if ($material && $group && ($material['uploaded_by'] == $_SESSION['user_id'] || $group['created_by'] == $_SESSION['user_id'] || $_SESSION['role'] === 'admin')) {
            $file_path = UPLOAD_PATH . $material['file_path'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            
            $materialModel->delete($id);
            $_SESSION['flash_message'] = "Materi berhasil dihapus.";
            $_SESSION['flash_type'] = "success";
        }
        header('Location: ' . BASE_URL . '?page=groups&action=show&id=' . $group_id);
        exit;
    }
}
?>
