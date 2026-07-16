# Instruksi untuk AI Coding Agent — Study Group Organizer

Dokumen ini adalah entry point instruksi untuk AI agent (Claude Code atau agent lain) yang membangun project ini. **Baca dokumen berikut secara berurutan sebelum menulis kode apa pun:**

1. `PRD.md` — tujuan, scope, requirement fungsional & non-fungsional
2. `FEATURES.md` — prioritas fitur (P0 wajib → P1 → P2), kerjakan berurutan
3. `DATABASE_SCHEMA.md` — DDL tabel, jalankan/pastikan schema ini yang dipakai, jangan mengarang skema baru
4. `FOLDER_STRUCTURE.md` — lokasi setiap file wajib mengikuti struktur ini persis
5. `INSTALLATION.md` — cara koneksi DB, cara menambah library

## Konteks Tugas

Ini adalah tugas UAS individu mata kuliah Praktikum Pemrograman Web. Tugas dinilai berdasarkan: kelengkapan CRUD, native PHP (tanpa framework), tampilan responsif (Bootstrap/Tailwind), dan MySQL sebagai database. **Jangan menyarankan atau memasang framework PHP (Laravel, CodeIgniter, Slim, dll) maupun Composer/autoload package manager** — gunakan native PHP murni sesuai requirement soal.

## Aturan Wajib Saat Menulis Kode

1. **Database access**: selalu gunakan PDO dengan **prepared statements**. Contoh pola:
   ```php
   $stmt = $pdo->prepare("SELECT * FROM study_groups WHERE subject_id = :subject_id");
   $stmt->execute(['subject_id' => $subjectId]);
   $groups = $stmt->fetchAll();
   ```
   Jangan pernah melakukan concatenation string langsung ke query SQL.

2. **Password**: gunakan `password_hash($password, PASSWORD_DEFAULT)` saat register, dan `password_verify()` saat login. Jangan simpan/log plain text password.

3. **Output ke HTML**: gunakan `htmlspecialchars()` untuk semua data user yang ditampilkan di view, guna mencegah XSS.

4. **Session**: `session_start()` di awal setiap entry point (bisa lewat `config/config.php` yang di-include di `index.php`). Simpan minimal `user_id` dan `role` di `$_SESSION` setelah login berhasil.

5. **Otorisasi per role**: setiap controller admin (`UserController`, `SubjectController`) wajib mengecek `$_SESSION['role'] === 'admin'` sebelum memproses request, jika tidak → redirect/403.

6. **Upload file** (materi): validasi ekstensi & ukuran file sebelum `move_uploaded_file()`, simpan ke `/uploads/materials/` dengan nama unik (`{group_id}_{time()}_{basename asli}`), simpan path relatif di kolom `file_path`.

7. **Struktur file**: taruh file baru sesuai lokasi persis di `FOLDER_STRUCTURE.md`. Jangan membuat pola folder baru di luar itu tanpa alasan kuat.

8. **Library pihak ketiga**: jika benar-benar diperlukan (lihat rekomendasi di `INSTALLATION.md`), taruh di `/library/{NamaLibrary}/` dan `require_once` manual — **jangan** menyarankan `composer require`.

## Urutan Pengerjaan yang Disarankan

1. Setup: `config/database.php`, `config/config.php`, jalankan schema dari `DATABASE_SCHEMA.md`.
2. Layout dasar: `views/layouts/header.php`, `navbar.php`, `footer.php` + integrasi Bootstrap/Tailwind CDN.
3. Modul Auth: register, login, logout, session guard.
4. Modul Admin: CRUD Users, CRUD Subjects.
5. Modul Kelompok Belajar: CRUD study_groups + join/leave (group_members).
6. Modul Jadwal: CRUD schedules.
7. Modul Materi: CRUD materials (termasuk upload/hapus file fisik).
8. Modul Komentar: CRUD comments.
9. Dashboard ringkasan per role.
10. QA responsif (test di lebar mobile & desktop) dan uji seluruh alur CRUD dari awal sampai akhir.
11. Baru lanjut fitur P1/P2 di `FEATURES.md` jika waktu tersisa.

## Definition of Done per Fitur

Sebuah fitur CRUD dianggap selesai jika: form create tervalidasi & tersimpan ke DB, halaman list menampilkan data ter-update, form edit ter-prefill dengan data existing dan berhasil update, aksi delete menghapus data (dan file fisik terkait bila ada) dengan konfirmasi, serta seluruh langkah di atas terlihat benar di tampilan mobile.

## Yang Jangan Dilakukan

- Jangan pakai framework PHP atau ORM apa pun.
- Jangan pakai Composer.
- Jangan membangun infrastruktur WebSocket/real-time video call sendiri — cukup field link eksternal (lihat `PRD.md` §3 Non-Goals).
- Jangan menyimpan kredensial database asli di file yang di-commit ke GitHub publik — gunakan contoh generik (`root` / password kosong) sesuai `INSTALLATION.md`.
- Jangan menggabungkan banyak modul dalam satu file controller besar — pisahkan per entitas sesuai `FOLDER_STRUCTURE.md`.

## Setelah Kode Selesai

Agent dapat membantu menyiapkan draf checklist laporan (deskripsi project, poin-poin fitur yang perlu di-screenshot) berdasarkan `FEATURES.md`, tetapi **pengambilan screenshot, rekaman video, dan proses upload ke YouTube/GitHub tetap dilakukan manual oleh mahasiswa** sesuai ketentuan pengumpulan pada soal UAS.
