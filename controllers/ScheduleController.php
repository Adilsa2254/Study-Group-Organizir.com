<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL);
    exit;
}

require_once 'models/Schedule.php';
require_once 'models/StudyGroup.php';

$scheduleModel = new Schedule($pdo);
$groupModel = new StudyGroup($pdo);
$action = $_GET['action'] ?? 'index';

if ($action === 'create') {
    $group_id = $_GET['group_id'] ?? 0;
    
    // verify group access
    $group = $groupModel->findById($group_id);
    if (!$group) {
        header('Location: ' . BASE_URL . '?page=groups');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $start_time = $_POST['start_time'] ?? '';
        $end_time = $_POST['end_time'] ?? '';
        $location = $_POST['location'] ?? '';
        $meeting_link = $_POST['meeting_link'] ?? '';
        
        $scheduleModel->create($group_id, $title, $description, $start_time, $end_time, $location, $meeting_link, $_SESSION['user_id']);
        $_SESSION['flash_message'] = "Jadwal berhasil ditambahkan.";
        $_SESSION['flash_type'] = "success";
        header('Location: ' . BASE_URL . '?page=groups&action=show&id=' . $group_id);
        exit;
    }
    require 'views/groups/schedules_form.php';
}
elseif ($action === 'edit') {
    $id = $_GET['id'] ?? 0;
    $schedule = $scheduleModel->findById($id);
    
    if (!$schedule) {
        header('Location: ' . BASE_URL . '?page=groups');
        exit;
    }
    
    $group_id = $schedule['group_id'];
    $group = $groupModel->findById($group_id);
    
    // Authorization: only creator of schedule, creator of group, or admin
    if ($schedule['created_by'] != $_SESSION['user_id'] && $group['created_by'] != $_SESSION['user_id'] && $_SESSION['role'] !== 'admin') {
        header('Location: ' . BASE_URL . '?page=groups&action=show&id=' . $group_id);
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $start_time = $_POST['start_time'] ?? '';
        $end_time = $_POST['end_time'] ?? '';
        $location = $_POST['location'] ?? '';
        $meeting_link = $_POST['meeting_link'] ?? '';
        
        $scheduleModel->update($id, $title, $description, $start_time, $end_time, $location, $meeting_link);
        $_SESSION['flash_message'] = "Jadwal berhasil diperbarui.";
        $_SESSION['flash_type'] = "success";
        header('Location: ' . BASE_URL . '?page=groups&action=show&id=' . $group_id);
        exit;
    }
    require 'views/groups/schedules_form.php';
}
elseif ($action === 'delete') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        $group_id = $_POST['group_id'] ?? 0;
        
        $schedule = $scheduleModel->findById($id);
        $group = $groupModel->findById($group_id);
        
        if ($schedule && $group && ($schedule['created_by'] == $_SESSION['user_id'] || $group['created_by'] == $_SESSION['user_id'] || $_SESSION['role'] === 'admin')) {
            $scheduleModel->delete($id);
            $_SESSION['flash_message'] = "Jadwal berhasil dihapus.";
            $_SESSION['flash_type'] = "success";
        }
        header('Location: ' . BASE_URL . '?page=groups&action=show&id=' . $group_id);
        exit;
    }
}
?>
