<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL);
    exit;
}

require_once 'models/StudyGroup.php';
require_once 'models/Schedule.php';

$groupModel = new StudyGroup($pdo);
$scheduleModel = new Schedule($pdo);

$user_id = $_SESSION['user_id'];
$myGroups = $groupModel->getJoinedGroups($user_id);

$upcomingSchedules = [];
if (!empty($myGroups)) {
    $groupIds = array_column($myGroups, 'id');
    $upcomingSchedules = $scheduleModel->getUpcomingByGroups($groupIds, 5);
}

require 'views/student/dashboard.php';
?>
