CREATE DATABASE IF NOT EXISTS study_group_organizer CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE study_group_organizer;
SET FOREIGN_KEY_CHECKS = 0;

-- Hapus tabel lama jika ada agar bersih
DROP TABLE IF EXISTS comments, materials, schedules, group_members, study_groups, mentor_requests, user_subjects, subjects, users, announcements, groups, notes, poll_options, poll_votes, session_rsvp, sessions;

-- 1. USERS
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_photo VARCHAR(255) DEFAULT NULL,
    role ENUM('admin', 'student', 'mentor') NOT NULL DEFAULT 'student',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2. SUBJECTS (Mata Pelajaran)
CREATE TABLE subjects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. STUDY GROUPS (Kelompok Belajar)
CREATE TABLE study_groups (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subject_id INT UNSIGNED NOT NULL,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    max_members INT UNSIGNED DEFAULT 10,
    created_by INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 4. GROUP MEMBERS (Anggota Kelompok)
CREATE TABLE group_members (
    group_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role_in_group ENUM('member', 'mentor', 'leader') DEFAULT 'member',
    PRIMARY KEY (group_id, user_id),
    FOREIGN KEY (group_id) REFERENCES study_groups(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 5. SCHEDULES (Jadwal Belajar)
CREATE TABLE schedules (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    group_id INT UNSIGNED NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    location VARCHAR(255) DEFAULT NULL,
    meeting_link VARCHAR(255) DEFAULT NULL,
    created_by INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES study_groups(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 6. MATERIALS (Materi / Catatan)
CREATE TABLE materials (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    group_id INT UNSIGNED NOT NULL,
    uploaded_by INT UNSIGNED NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    file_path VARCHAR(255) NOT NULL, 
    file_type VARCHAR(50) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES study_groups(id) ON DELETE CASCADE,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 7. COMMENTS (Diskusi Materi)
CREATE TABLE comments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    material_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    comment_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (material_id) REFERENCES materials(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ==========================================
-- DATA SEED (Data Awal)
-- ==========================================
-- Password untuk semua akun di bawah adalah: password123
INSERT INTO users (name, email, password, role) VALUES 
('Admin Utama', 'admin@studygroup.com', '$2y$12$64K9mbp3QpRgcfLCMbvnaOILoVh74Kf/Df8FDUZlgSt0g9gDpIc.2', 'admin'),
('Budi Siswa', 'budi@siswa.com', '$2y$12$64K9mbp3QpRgcfLCMbvnaOILoVh74Kf/Df8FDUZlgSt0g9gDpIc.2', 'student'),
('Siti Siswa', 'siti@siswa.com', '$2y$12$64K9mbp3QpRgcfLCMbvnaOILoVh74Kf/Df8FDUZlgSt0g9gDpIc.2', 'student');

INSERT INTO subjects (name, description) VALUES 
('Matematika', 'Belajar kalkulus, aljabar, trigonometri, dan statistika'),
('Fisika', 'Fisika dasar, mekanika, dan termodinamika'),
('Pemrograman Web', 'HTML, CSS, JavaScript, PHP, dan MySQL'),
('Biologi', 'Anatomi, genetika, sel, dan ekosistem'),
('Kimia', 'Kimia organik, anorganik, dan tabel periodik'),
('Bahasa Inggris', 'Grammar, TOEFL, IELTS, dan percakapan'),
('Algoritma & Struktur Data', 'Array, Linked List, Tree, Graph, dan Sorting'),
('Jaringan Komputer', 'Topologi, OSI Layer, Cisco, dan Keamanan Jaringan'),
('Desain Grafis', 'UI/UX, Photoshop, Illustrator, dan Figma'),
('Manajemen & Bisnis', 'Akuntansi dasar, pemasaran, dan manajemen operasional'),
('Sejarah', 'Sejarah dunia, sejarah Indonesia, dan peradaban kuno'),
('Kecerdasan Buatan', 'Machine Learning, Deep Learning, dan Data Science');
