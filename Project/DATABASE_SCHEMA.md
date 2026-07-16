# Database Schema — Study Group Organizer

Database engine: **MySQL** (InnoDB, utf8mb4). Nama database yang disarankan: `study_group_organizer`.

## 1. Entity Relationship Overview

```
users ───< group_members >─── study_groups ───> subjects
  │                                  │
  │                                  ├──< schedules
  │                                  └──< materials ──< comments
  │
  └──< mentor_requests (opsional)
  └──< messages (opsional, via study_groups)
```

- Satu `user` bisa menjadi anggota banyak `study_groups` (many-to-many via `group_members`).
- Satu `study_group` terhubung ke satu `subject` (many-to-one).
- Satu `study_group` punya banyak `schedules`, `materials`, dan `messages`.
- Satu `material` punya banyak `comments`.

## 2. DDL (Data Definition Language)

```sql
CREATE DATABASE IF NOT EXISTS study_group_organizer
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE study_group_organizer;

-- 1. USERS
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,       -- hasil password_hash()
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

-- 4. GROUP MEMBERS (relasi many-to-many users <-> study_groups)
CREATE TABLE group_members (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    group_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    role_in_group ENUM('member', 'mentor') NOT NULL DEFAULT 'member',
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_group_user (group_id, user_id),
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
    location VARCHAR(255) DEFAULT NULL,      -- lokasi fisik atau catatan tambahan
    meeting_link VARCHAR(255) DEFAULT NULL,  -- link Jitsi/Google Meet (opsional, P1)
    created_by INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
    file_path VARCHAR(255) NOT NULL,   -- path relatif di /uploads
    file_type VARCHAR(50) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES study_groups(id) ON DELETE CASCADE,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 7. COMMENTS (Komentar pada Materi)
CREATE TABLE comments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    material_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    comment_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (material_id) REFERENCES materials(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 8. MESSAGES (Chat sederhana per kelompok — opsional, P1)
CREATE TABLE messages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    group_id INT UNSIGNED NOT NULL,
    sender_id INT UNSIGNED NOT NULL,
    message TEXT NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES study_groups(id) ON DELETE CASCADE,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 9. MENTOR REQUESTS (opsional, P2)
CREATE TABLE mentor_requests (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT UNSIGNED NOT NULL,
    mentor_id INT UNSIGNED NOT NULL,
    subject_id INT UNSIGNED NOT NULL,
    status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (mentor_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE
) ENGINE=InnoDB;
```

## 3. Data Seed Minimum (untuk testing)

```sql
INSERT INTO users (name, email, password, role) VALUES
('Admin Utama', 'admin@sgo.test', '$2y$10$examplehashchangeme', 'admin');
-- Ganti password hash di atas dengan hasil password_hash('password_asli', PASSWORD_DEFAULT)

INSERT INTO subjects (name, description) VALUES
('Matematika', 'Kelompok belajar seputar matematika'),
('Bahasa Inggris', 'Kelompok belajar bahasa Inggris'),
('Pemrograman', 'Kelompok belajar dasar pemrograman');
```

## 4. Catatan Implementasi

- Semua akses ke tabel di atas **wajib** melalui **PDO prepared statements** — lihat contoh pola query di `CLAUDE.md`.
- Kolom `password` menyimpan hasil `password_hash()`, **jangan pernah** menyimpan plain text.
- Saat menghapus `study_groups`, relasi ke `group_members`, `schedules`, `materials` otomatis terhapus (ON DELETE CASCADE) — pastikan file fisik di `/uploads` juga dihapus lewat kode PHP (`unlink()`) sebelum/scaligned dengan hapus record `materials`.
- Simpan file dump akhir sebagai `database/study_group_organizer.sql` di repository GitHub sesuai ketentuan pengumpulan tugas.
