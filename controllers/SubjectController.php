<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ' . BASE_URL);
    exit;
}

require_once 'models/Subject.php';
$subjectModel = new Subject($pdo);
$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    $subjects = $subjectModel->getAll();
    require 'views/admin/subjects_index.php';
} 
elseif ($action === 'create') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        
        $subjectModel->create($name, $description);
        $_SESSION['flash_message'] = "Mata Pelajaran berhasil ditambahkan.";
        $_SESSION['flash_type'] = "success";
        header('Location: ' . BASE_URL . '?page=subjects');
        exit;
    }
    require 'views/admin/subjects_form.php';
}
elseif ($action === 'edit') {
    $id = $_GET['id'] ?? 0;
    $subject = $subjectModel->findById($id);
    if (!$subject) {
        header('Location: ' . BASE_URL . '?page=subjects');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        
        $subjectModel->update($id, $name, $description);
        $_SESSION['flash_message'] = "Mata Pelajaran berhasil diupdate.";
        $_SESSION['flash_type'] = "success";
        header('Location: ' . BASE_URL . '?page=subjects');
        exit;
    }
    require 'views/admin/subjects_form.php';
}
elseif ($action === 'delete') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        $subjectModel->delete($id);
        $_SESSION['flash_message'] = "Mata Pelajaran berhasil dihapus.";
        $_SESSION['flash_type'] = "success";
    }
    header('Location: ' . BASE_URL . '?page=subjects');
    exit;
}
?>
