<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL);
    exit;
}

require_once 'models/StudyGroup.php';
require_once 'models/GroupMember.php';
require_once 'models/Subject.php';
require_once 'models/Schedule.php';
require_once 'models/Material.php';
require_once 'models/Comment.php';

$groupModel = new StudyGroup($pdo);
$memberModel = new GroupMember($pdo);
$subjectModel = new Subject($pdo);
$scheduleModel = new Schedule($pdo);
$materialModel = new Material($pdo);
// Comment model can be loaded when viewing a group later
// $commentModel = new Comment($pdo);

$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    $subject_id = $_GET['subject_id'] ?? null;
    $keyword = $_GET['q'] ?? null;
    
    $groups = $groupModel->getAll($subject_id, $keyword);
    $subjects = $subjectModel->getAll();
    require 'views/groups/index.php';
}
elseif ($action === 'show') {
    $id = $_GET['id'] ?? 0;
    $group = $groupModel->findById($id);
    if (!$group) {
        header('Location: ' . BASE_URL . '?page=groups');
        exit;
    }
    
    $members = $memberModel->getMembers($id);
    $is_member = $memberModel->isMember($id, $_SESSION['user_id']);
    $is_creator = $group['created_by'] == $_SESSION['user_id'];
    $is_admin = $_SESSION['role'] === 'admin';
    
    // Get schedules and materials
    $schedules = $scheduleModel->getByGroup($id);
    $materials = $materialModel->getByGroup($id);
    
    // For simplicity, we can load comments directly here or via AJAX. We'll do it natively by looping inside the view for each material if we don't have too many, or separate view. Let's do a simple approach.
    require_once 'models/Comment.php';
    $commentModel = new Comment($pdo);
    $materialsWithComments = [];
    foreach ($materials as $mat) {
        $mat['comments'] = $commentModel->getByMaterial($mat['id']);
        $materialsWithComments[] = $mat;
    }
    
    require 'views/groups/show.php';
}
elseif ($action === 'create') {
    $subjects = $subjectModel->getAll();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $subject_id = $_POST['subject_id'] ?? '';
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $max_members = (int)($_POST['max_members'] ?? 10);
        
        $group_id = $groupModel->create($subject_id, $name, $description, $max_members, $_SESSION['user_id']);
        
        // Add creator as member
        $memberModel->addMember($group_id, $_SESSION['user_id']);
        
        $_SESSION['flash_message'] = "Kelompok belajar berhasil dibuat.";
        $_SESSION['flash_type'] = "success";
        header('Location: ' . BASE_URL . '?page=groups&action=show&id=' . $group_id);
        exit;
    }
    
    require 'views/groups/form.php';
}
elseif ($action === 'edit') {
    $id = $_GET['id'] ?? 0;
    $group = $groupModel->findById($id);
    
    if (!$group || ($group['created_by'] != $_SESSION['user_id'] && $_SESSION['role'] !== 'admin')) {
        header('Location: ' . BASE_URL . '?page=groups');
        exit;
    }
    
    $subjects = $subjectModel->getAll();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $subject_id = $_POST['subject_id'] ?? '';
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $max_members = (int)($_POST['max_members'] ?? 10);
        
        $groupModel->update($id, $subject_id, $name, $description, $max_members);
        
        $_SESSION['flash_message'] = "Detail kelompok belajar berhasil diperbarui.";
        $_SESSION['flash_type'] = "success";
        header('Location: ' . BASE_URL . '?page=groups&action=show&id=' . $id);
        exit;
    }
    
    require 'views/groups/form.php';
}
elseif ($action === 'delete') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        $group = $groupModel->findById($id);
        if ($group && ($group['created_by'] == $_SESSION['user_id'] || $_SESSION['role'] === 'admin')) {
            $groupModel->delete($id);
            $_SESSION['flash_message'] = "Kelompok belajar berhasil dihapus.";
            $_SESSION['flash_type'] = "success";
        }
    }
    header('Location: ' . BASE_URL . '?page=groups');
    exit;
}
elseif ($action === 'join') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        $group = $groupModel->findById($id);
        
        if ($group) {
            $memberModel->addMember($id, $_SESSION['user_id']);
            $_SESSION['flash_message'] = "Berhasil bergabung ke kelompok.";
            $_SESSION['flash_type'] = "success";
        }
    }
    header('Location: ' . BASE_URL . '?page=groups&action=show&id=' . $id);
    exit;
}
elseif ($action === 'leave') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        $group = $groupModel->findById($id);
        
        if ($group && $group['created_by'] != $_SESSION['user_id']) {
            $memberModel->removeMember($id, $_SESSION['user_id']);
            $_SESSION['flash_message'] = "Berhasil keluar dari kelompok.";
            $_SESSION['flash_type'] = "info";
        } else {
            $_SESSION['flash_message'] = "Pembuat kelompok tidak bisa keluar, silakan hapus kelompok.";
            $_SESSION['flash_type'] = "danger";
        }
    }
    header('Location: ' . BASE_URL . '?page=groups&action=show&id=' . $id);
    exit;
}
elseif ($action === 'export_pdf') {
    $id = $_GET['id'] ?? 0;
    $group = $groupModel->findById($id);
    
    if (!$group) {
        header('Location: ' . BASE_URL . '?page=groups');
        exit;
    }
    
    $members = $memberModel->getMembers($id);
    
    require_once 'library/fpdf/fpdf.php';
    
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Title
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,'Laporan Kelompok Belajar',0,1,'C');
    $pdf->Ln(5);
    
    // Group Details
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,8,'Nama Kelompok',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,8,': ' . $group['name'],0,1);
    
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,8,'Mata Pelajaran',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,8,': ' . $group['subject_name'],0,1);
    
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,8,'Dibuat Oleh',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,8,': ' . $group['creator_name'],0,1);
    
    $pdf->Ln(10);
    
    // Members Table
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,10,'Daftar Anggota (' . count($members) . '/' . $group['max_members'] . '):',0,1);
    
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,8,'No',1,0,'C');
    $pdf->Cell(60,8,'Nama',1,0,'C');
    $pdf->Cell(70,8,'Email',1,0,'C');
    $pdf->Cell(50,8,'Tanggal Bergabung',1,0,'C');
    $pdf->Ln();
    
    $pdf->SetFont('Arial','',10);
    $no = 1;
    foreach($members as $m) {
        $pdf->Cell(10,8,$no++,1,0,'C');
        $pdf->Cell(60,8,$m['user_name'],1);
        $pdf->Cell(70,8,$m['user_email'],1);
        $pdf->Cell(50,8,date('d M Y', strtotime($m['joined_at'])),1,0,'C');
        $pdf->Ln();
    }
    
    $pdf->Output('D', 'Laporan_Kelompok_' . preg_replace('/[^A-Za-z0-9\-]/', '_', $group['name']) . '.pdf');
    exit;
}
elseif ($action === 'export_excel') {
    $id = $_GET['id'] ?? 0;
    $group = $groupModel->findById($id);
    
    if (!$group) {
        header('Location: ' . BASE_URL . '?page=groups');
        exit;
    }
    
    $members = $memberModel->getMembers($id);
    
    require_once 'library/SimpleXLSXGen/SimpleXLSXGen.php';
    
    $data = [
        ['<center><b>Laporan Data Anggota Kelompok Belajar</b></center>', '', '', ''],
        ['', '', '', ''],
        ['<b>Nama Kelompok</b>', $group['name'], '', ''],
        ['<b>Mata Pelajaran</b>', $group['subject_name'], '', ''],
        ['<b>Dibuat Oleh</b>', $group['creator_name'], '', ''],
        ['', '', '', ''],
        ['<b>No</b>', '<b>Nama</b>', '<b>Email</b>', '<b>Tanggal Bergabung</b>']
    ];
    
    $no = 1;
    foreach($members as $m) {
        $data[] = [
            $no++,
            $m['user_name'],
            $m['user_email'],
            date('d M Y', strtotime($m['joined_at']))
        ];
    }
    
    $filename = 'Laporan_Anggota_' . preg_replace('/[^A-Za-z0-9\-]/', '_', $group['name']) . '.xlsx';
    
    $xlsx = Shuchkin\SimpleXLSXGen::fromArray($data);
    $xlsx->downloadAs($filename);
    exit;
}
?>
