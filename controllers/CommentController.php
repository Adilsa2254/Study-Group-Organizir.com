<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL);
    exit;
}

require_once 'models/Comment.php';

$commentModel = new Comment($pdo);
$action = $_GET['action'] ?? '';

if ($action === 'create') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $material_id = $_POST['material_id'] ?? 0;
        $group_id = $_POST['group_id'] ?? 0;
        $comment_text = trim($_POST['comment_text'] ?? '');
        
        if (!empty($comment_text)) {
            $commentModel->create($material_id, $_SESSION['user_id'], $comment_text);
            $_SESSION['flash_message'] = "Komentar ditambahkan.";
            $_SESSION['flash_type'] = "success";
        }
        header('Location: ' . BASE_URL . '?page=groups&action=show&id=' . $group_id);
        exit;
    }
}
elseif ($action === 'delete') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        $group_id = $_POST['group_id'] ?? 0;
        
        $comment = $commentModel->findById($id);
        
        if ($comment && ($comment['user_id'] == $_SESSION['user_id'] || $_SESSION['role'] === 'admin')) {
            $commentModel->delete($id);
            $_SESSION['flash_message'] = "Komentar dihapus.";
            $_SESSION['flash_type'] = "success";
        }
        header('Location: ' . BASE_URL . '?page=groups&action=show&id=' . $group_id);
        exit;
    }
}
?>
