<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ' . BASE_URL);
    exit;
}

// Get stats
$stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
$usersCount = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) as count FROM study_groups");
$groupsCount = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) as count FROM subjects");
$subjectsCount = $stmt->fetch()['count'];

require 'views/admin/dashboard.php';
?>
