# Product Requirement Document (PRD)
## Study Group Organizer

**Mata Kuliah**: Praktikum Pemrograman Web — UAS
**Dosen**: Budi Sulistyo Jati, S.Kom., M.Eng.
**Sifat tugas**: Individu

---

## 1. Latar Belakang

Soal UAS mewajibkan pembuatan aplikasi web dengan fungsi **CRUD lengkap** (Create, Read, Update, Delete) menggunakan **native PHP**, tampilan **responsif** (Bootstrap/Tailwind), dan **MySQL** sebagai basis data. Tema yang dipilih adalah **Study Group Organizer**: platform kolaboratif agar siswa bisa membentuk kelompok belajar, mengatur jadwal, berbagi materi, dan berdiskusi.

## 2. Tujuan

1. Memenuhi seluruh requirement wajib pada soal UAS (CRUD dashboard, responsif, native PHP, MySQL).
2. Menghadirkan alur kerja yang relevan dengan tema Study Group Organizer secara realistis dalam batas waktu pengerjaan individu.
3. Menghasilkan aplikasi yang mudah didemokan dalam video presentasi (≤10 menit) dan dilaporkan dalam PDF.

## 3. Non-Goals (di luar cakupan wajib)

Fitur berikut **boleh** diimplementasikan sebagai nilai tambah, tetapi **bukan syarat kelulusan** tugas ini karena kompleksitasnya (real-time infrastructure) tidak proporsional untuk tugas individu berbasis native PHP:

- Video call native (cukup diakali dengan embed link Jitsi Meet/Google Meet pada jadwal grup, tanpa membangun signaling server sendiri).
- Chat real-time berbasis WebSocket. Cukup menggunakan pendekatan AJAX polling sederhana atau bahkan dijadikan fitur opsional tahap akhir.
- Sinkronisasi ke Google Calendar/kalender eksternal via API pihak ketiga.

Lihat `FEATURES.md` untuk pembagian MVP vs opsional secara rinci.

## 4. Target Pengguna & Role

| Role | Deskripsi |
|---|---|
| **Admin** | Mengelola data master: users, mata pelajaran, moderasi kelompok belajar |
| **Siswa (Student)** | Membuat/bergabung kelompok belajar, membuat jadwal, upload materi, berkomentar |
| **Mentor** (opsional) | Siswa tingkat lanjut yang bisa didaftarkan sebagai pembimbing pada kelompok tertentu |

## 5. Alur Pengguna Utama (User Flow)

1. Siswa registrasi & login.
2. Siswa memilih mata pelajaran minat → melihat daftar kelompok belajar terkait → bergabung atau membuat kelompok baru.
3. Di dalam kelompok: siswa dapat membuat jadwal belajar bersama, mengunggah catatan/materi, dan memberi komentar pada materi yang diunggah anggota lain.
4. Admin memantau & mengelola seluruh data melalui dashboard admin (CRUD users, mata pelajaran, dan moderasi grup/materi bila diperlukan).

## 6. Functional Requirements

### 6.1 Wajib (memenuhi soal UAS)
- **Auth**: Register, Login, Logout, session-based authentication.
- **CRUD Users** (Admin): create, read, update, delete/nonaktifkan akun siswa.
- **CRUD Mata Pelajaran** (Admin): kategori minat belajar.
- **CRUD Kelompok Belajar** (Siswa): buat, lihat, ubah, hapus kelompok yang dimiliki/diikuti.
- **CRUD Jadwal Belajar**: buat, lihat, ubah, hapus sesi belajar dalam kelompok.
- **CRUD Materi/Catatan**: upload, lihat, ubah metadata, hapus file materi.
- **CRUD Komentar**: tambah, lihat, ubah, hapus komentar pada materi.
- **Dashboard** menampilkan ringkasan data (jumlah kelompok, jadwal mendatang, materi terbaru) sesuai role user yang login.
- **Responsif**: seluruh halaman dapat digunakan baik di desktop maupun mobile.

### 6.2 Opsional (nilai tambah, dikerjakan jika waktu memungkinkan)
- Sistem permintaan mentor (mentor request) antar siswa.
- Chat sederhana per-kelompok (AJAX polling).
- Link video call (kolom URL Jitsi/Meet pada jadwal, bukan fitur real-time custom).
- Notifikasi jadwal mendekati waktu pelaksanaan.
- Pencarian & filter kelompok berdasarkan mata pelajaran.

## 7. Non-Functional Requirements

- **Keamanan**: password di-hash (`password_hash`/`password_verify`), semua query menggunakan **prepared statements (PDO)**, validasi & sanitasi input, proteksi terhadap XSS (`htmlspecialchars`) dan CSRF token pada form penting.
- **Responsif**: menggunakan grid system Bootstrap 5 (atau Tailwind), diuji pada breakpoint mobile, tablet, desktop.
- **Struktur kode**: mengikuti pola MVC manual sesuai `FOLDER_STRUCTURE.md`, tanpa framework PHP (native PHP murni), library pihak ketiga (jika ada) disimpan manual di `/library`.
- **Portabilitas**: dapat dijalankan di XAMPP/Laragon (localhost) tanpa dependency eksternal selain PHP & MySQL.
- **Dokumentasi**: setiap fitur di-screenshot untuk laporan PDF; struktur database di-screenshot; kode & dump `.sql` diunggah ke GitHub.

## 8. Entitas Data Utama

Lihat detail skema di `DATABASE_SCHEMA.md`. Ringkasan entitas:

`users`, `subjects` (mata_pelajaran), `study_groups` (kelompok_belajar), `group_members` (anggota_kelompok), `schedules` (jadwal_belajar), `materials` (materi), `comments` (komentar), dan opsional `mentor_requests`, `messages`.

## 9. Kriteria Selesai (Definition of Done)

- [ ] Semua fitur wajib pada §6.1 berfungsi end-to-end (create → read → update → delete teruji).
- [ ] Tampilan responsif diverifikasi di lebar layar mobile (≤576px) dan desktop.
- [ ] Tidak ada query SQL yang rentan SQL Injection (semua pakai prepared statement).
- [ ] Dump database (`.sql`) tersedia dan bisa di-import ulang tanpa error.
- [ ] Kode di-push ke GitHub (public/private + akses jelas) sesuai ketentuan pengumpulan.
- [ ] Video presentasi ≤10 menit dibuat sesuai checklist (deskripsi, alur CRUD, daftar fitur, wajah tampil).
- [ ] Laporan PDF berisi deskripsi project, screenshot fitur, screenshot database, URL GitHub, URL video.

## 10. Risiko & Mitigasi

| Risiko | Mitigasi |
|---|---|
| Fitur tema terlalu ambisius (chat/video call real-time) untuk tugas individu | Batasi ke MVP wajib dahulu, fitur real-time diganti pendekatan sederhana (embed link, polling) |
| Waktu pengerjaan sempit menjelang deadline | Ikuti urutan prioritas di `FEATURES.md`, MVP dulu baru opsional |
| Struktur kode berantakan tanpa framework | Disiplin mengikuti `FOLDER_STRUCTURE.md` sejak awal |
