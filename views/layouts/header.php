<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Group Organizer</title>
    <!-- Google Fonts: Outfit for modern look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #10b981;
            --bg-color: #f3f4f6;
            --card-bg: rgba(255, 255, 255, 0.9);
            --text-main: #1f2937;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(at 0% 0%, hsla(253,16%,7%,0) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(225,39%,30%,0.05) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(339,49%,30%,0.05) 0, transparent 50%);
            color: var(--text-main);
            min-height: 100vh;
        }
        
        /* Navbar Glassmorphism */
        .navbar {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--primary) !important;
            letter-spacing: -0.5px;
            font-size: 1.5rem;
        }
        .navbar-light .navbar-nav .nav-link {
            color: #4b5563;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        .navbar-light .navbar-nav .nav-link:hover,
        .navbar-light .navbar-nav .nav-link.active {
            color: var(--primary);
            background: rgba(79, 70, 229, 0.1);
        }
        
        /* Cards */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.8);
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        }
        
        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2), 0 2px 4px -1px rgba(79, 70, 229, 0.1);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3), 0 4px 6px -2px rgba(79, 70, 229, 0.15);
        }
        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
            border-radius: 0.5rem;
            font-weight: 500;
        }
        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
        }
        
        /* Typography & Layouts */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            color: #111827;
            letter-spacing: -0.5px;
        }
        .text-primary { color: var(--primary) !important; }
        .bg-primary { background-color: var(--primary) !important; }
        
        /* Form inputs */
        .form-control, .form-select {
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            padding: 0.6rem 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
        
        /* Custom Nav Tabs */
        .nav-tabs-custom {
            border-bottom: 2px solid #e5e7eb;
            gap: 1rem;
        }
        .nav-tabs-custom .nav-link {
            border: none;
            color: #6b7280;
            background: transparent;
            border-bottom: 3px solid transparent;
            border-radius: 0;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        .nav-tabs-custom .nav-link:hover {
            color: var(--primary);
            border-bottom: 3px solid rgba(79, 70, 229, 0.3);
        }
        .nav-tabs-custom .nav-link.active {
            color: var(--primary);
            border-bottom: 3px solid var(--primary);
            background: transparent;
        }

        /* Modern Alerts */
        .alert {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        /* Soft Badges */
        .badge.bg-primary {
            background-color: rgba(79, 70, 229, 0.1) !important;
            color: var(--primary-dark) !important;
            border: 1px solid rgba(79, 70, 229, 0.2);
            font-weight: 600;
        }
        .badge.bg-success {
            background-color: rgba(16, 185, 129, 0.1) !important;
            color: #065f46 !important;
            border: 1px solid rgba(16, 185, 129, 0.2);
            font-weight: 600;
        }

        /* Empty States */
        .empty-state {
            background: rgba(255, 255, 255, 0.6);
            border: 1px dashed #d1d5db;
            border-radius: 1rem;
            padding: 3rem 2rem;
            text-align: center;
            color: #6b7280;
        }
        
        /* Back Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background: white;
            border-radius: 2rem;
            color: #4b5563;
            font-weight: 500;
            font-size: 0.9rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: all 0.2s;
            text-decoration: none;
        }
        .back-link:hover {
            color: var(--primary);
            transform: translateX(-4px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        /* Interactive List Items */
        .list-group-item-action {
            transition: all 0.2s ease;
        }
        .list-group-item-action:hover {
            background-color: #f8fafc;
            transform: translateY(-2px);
            z-index: 1;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        
        .card {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
<?php require 'views/layouts/navbar.php'; ?>
<div class="container py-4">
    <?php if(isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-<?= escape($_SESSION['flash_type'] ?? 'info') ?> alert-dismissible fade show" role="alert">
            <?= escape($_SESSION['flash_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php 
            unset($_SESSION['flash_message']);
            unset($_SESSION['flash_type']);
        ?>
    <?php endif; ?>
