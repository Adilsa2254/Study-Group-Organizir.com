<?php
session_start();

// Validasi session: jika ada user_id tapi name/role tidak ada, hancurkan session (session lama/rusak)
if (isset($_SESSION['user_id']) && (!isset($_SESSION['role']) || !isset($_SESSION['name']))) {
    session_destroy();
    session_start();
}

require_once 'config/config.php';
require_once 'config/database.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role'] === 'admin') {
                header('Location: ' . BASE_URL . '?page=dashboard_admin');
            } else {
                header('Location: ' . BASE_URL . '?page=dashboard_student');
            }
            exit;
        } else {
            header('Location: ' . BASE_URL . '?page=login');
            exit;
        }
        break;
        
    case 'login':
    case 'register':
    case 'logout':
        require 'controllers/AuthController.php';
        break;
        
    case 'dashboard_admin':
        require 'controllers/AdminController.php';
        break;
        
    case 'dashboard_student':
        require 'controllers/StudentDashboardController.php';
        break;

    case 'users':
        require 'controllers/UserController.php';
        break;
        
    case 'subjects':
        require 'controllers/SubjectController.php';
        break;
        
    case 'groups':
        require 'controllers/GroupController.php';
        break;
        
    case 'schedules':
        require 'controllers/ScheduleController.php';
        break;
        
    case 'materials':
        require 'controllers/MaterialController.php';
        break;
        
    case 'comments':
        require 'controllers/CommentController.php';
        break;
        
    default:
        http_response_code(404);
        require 'views/404.php';
        break;
}
?>
