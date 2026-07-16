# Daftar Fitur — Study Group Organizer

Fitur dibagi tiga tingkat prioritas. **Kerjakan berurutan dari P0 → P2.** Jangan mulai P1/P2 sebelum semua P0 selesai dan teruji, karena P0 adalah yang dinilai langsung oleh soal UAS.

Legenda modul CRUD: 🟢 Create · 🔵 Read · 🟡 Update · 🔴 Delete

---

## P0 — Wajib (memenuhi requirement soal UAS)

### 1. Autentikasi
- Register siswa (nama, email, password, mata pelajaran minat)
- Login / Logout dengan session
- Middleware sederhana: redirect ke login jika belum autentikasi; redirect ke dashboard sesuai role jika sudah login

### 2. Manajemen User (Admin) — full CRUD 🟢🔵🟡🔴
- Lihat daftar seluruh user (tabel + pencarian sederhana)
- Tambah user baru (termasuk set role: admin/student/mentor)
- Edit data user
- Hapus / nonaktifkan user

### 3. Manajemen Mata Pelajaran (Admin) — full CRUD 🟢🔵🟡🔴
- Tambah, lihat, edit, hapus mata pelajaran yang tersedia sebagai kategori minat

### 4. Kelompok Belajar (Siswa) — full CRUD 🟢🔵🟡🔴
- Buat kelompok belajar baru (nama, mata pelajaran, deskripsi, kapasitas anggota)
- Lihat daftar kelompok (filter berdasarkan mata pelajaran)
- Gabung/keluar kelompok (insert/delete di `group_members`)
- Edit detail kelompok (khusus pembuat/admin)
- Hapus kelompok (khusus pembuat/admin)

### 5. Jadwal Belajar Bersama — full CRUD 🟢🔵🟡🔴
- Buat jadwal sesi belajar dalam kelompok (judul, waktu mulai/selesai, lokasi/link)
- Lihat daftar jadwal (per kelompok & ringkasan "jadwal terdekat" di dashboard)
- Edit jadwal
- Hapus jadwal

### 6. Materi & Catatan — full CRUD 🟢🔵🟡🔴
- Upload file materi (pdf/gambar/dokumen) ke folder `/uploads` + metadata ke DB
- Lihat daftar materi per kelompok, unduh/preview file
- Edit metadata materi (judul, deskripsi)
- Hapus materi (file fisik + record DB)

### 7. Komentar pada Materi — full CRUD 🟢🔵🟡🔴
- Tambah komentar pada materi
- Lihat komentar (list di bawah materi)
- Edit komentar milik sendiri
- Hapus komentar milik sendiri (atau oleh admin)

### 8. Dashboard sesuai Role
- **Admin**: statistik total user, total kelompok, total mata pelajaran
- **Siswa**: kelompok yang diikuti, jadwal terdekat, materi terbaru dari kelompoknya

### 9. Tampilan Responsif
- Navbar collapsible (hamburger menu di mobile)
- Tabel data → scrollable / card-view di layar kecil
- Form input nyaman disentuh di layar mobile (touch target cukup besar)

---

## P1 — Nilai Tambah (kerjakan jika P0 sudah selesai & stabil)

### 10. Pencarian & Filter Kelompok
- Filter kelompok belajar berdasarkan mata pelajaran dan kata kunci nama

### 11. Link Video Call per Jadwal
- Kolom `meeting_link` pada tabel `schedules`, siswa tinggal tempel link Jitsi Meet/Google Meet saat membuat jadwal — **tidak perlu membangun infrastruktur video call sendiri**

### 12. Chat Sederhana per Kelompok
- Tabel `messages`, kirim pesan via form, tampil via AJAX polling (fetch tiap beberapa detik) — cukup untuk mendemokan "diskusi real-time" tanpa WebSocket

---

## P2 — Opsional Lanjutan (jika waktu sangat luang)

### 13. Mentor Request
- Siswa bisa mengajukan permintaan dibimbing oleh siswa lain berstatus mentor pada mata pelajaran tertentu
- Admin/mentor menyetujui atau menolak permintaan

### 14. Notifikasi Jadwal
- Badge/alert sederhana di dashboard untuk jadwal yang akan dimulai dalam 24 jam ke depan

---

## Pemetaan ke Kebutuhan Laporan UAS

Soal meminta laporan PDF berisi *deskripsi project, screenshot fitur, screenshot database, url GitHub, url video*. Gunakan urutan fitur P0 di atas sebagai urutan screenshot pada laporan dan sebagai urutan demo pada video presentasi, supaya alur CRUD terlihat jelas dan runtut.
