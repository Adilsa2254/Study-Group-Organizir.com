# Installation Guide — Study Group Organizer

## 1. Prasyarat

- PHP ≥ 8.0 (aktifkan ekstensi `pdo_mysql`)
- MySQL / MariaDB (lewat XAMPP, Laragon, atau instalasi manual)
- Web server: Apache (bundled XAMPP/Laragon) atau `php -S localhost:8000` untuk quick test
- Browser modern untuk testing responsif (gunakan DevTools device toolbar)

## 2. Setup Database

1. Jalankan MySQL (via XAMPP/Laragon Control Panel).
2. Buka phpMyAdmin atau CLI, jalankan seluruh DDL di `DATABASE_SCHEMA.md`, **atau** import file dump `database/study_group_organizer.sql` (dibuat setelah struktur final).
3. Sesuaikan kredensial koneksi di `config/database.php`:

```php
<?php
// config/database.php
$host = 'localhost';
$db   = 'study_group_organizer';
$user = 'root';
$pass = '';         // sesuaikan dengan setup lokal masing-masing
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Koneksi database gagal: ' . $e->getMessage());
}
```

## 3. Menjalankan Project

- Letakkan folder project di `htdocs` (XAMPP) atau `www` (Laragon).
- Akses lewat `http://localhost/study-group-organizer/`.
- Alternatif cepat tanpa Apache: `php -S localhost:8000` dari root folder project, lalu akses `http://localhost:8000`.

## 4. Menambahkan CSS Framework

Pilih salah satu (sesuai keputusan di `PRD.md`):

**Opsi A — Bootstrap 5 (via CDN, paling praktis untuk tugas)**
```html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
```
Taruh di `views/layouts/header.php` dan `footer.php`.

**Opsi B — Tailwind CSS (via CDN Play, untuk demo cepat)**
```html
<script src="https://cdn.tailwindcss.com"></script>
```
> Catatan: untuk penggunaan production disarankan Tailwind CLI/build step, tapi untuk tugas UAS CDN Play sudah cukup dan tetap dinilai valid sebagai "menggunakan Tailwind CSS".

## 5. Menambahkan Library PHP ke Folder `/library` (tanpa Composer)

Karena requirement soal adalah **native PHP**, library ditambahkan secara manual:

1. Unduh source library dari repository resminya (misalnya dari GitHub, pilih "Download ZIP" — hindari langkah `composer require`).
2. Ekstrak ke `/library/{NamaLibrary}/`, contoh: `/library/PHPMailer/`.
3. Include manual di file yang membutuhkan:

```php
require_once __DIR__ . '/../library/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../library/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../library/PHPMailer/src/Exception.php';
```

4. Catat setiap library yang ditambahkan (nama + versi + tujuan penggunaan) di `library/README.md` agar mudah dilaporkan di laporan PDF.

### Rekomendasi Library (opsional, pakai jika fitur terkait dikerjakan)

| Kebutuhan | Library | Catatan |
|---|---|---|
| Kirim email notifikasi (misal saat join kelompok) | PHPMailer | Opsional, hanya jika fitur notifikasi email dikerjakan |
| Export laporan/jadwal ke PDF | Dompdf | Opsional |
| Validasi tanggal/waktu lebih rapi | — | Native PHP `DateTime` sudah cukup, tidak perlu library tambahan |

> Untuk fitur wajib (P0), **tidak ada library PHP yang benar-benar diperlukan** — cukup native PHP (PDO, session, `password_hash`, `DateTime`, `move_uploaded_file`). Library baru relevan jika mengerjakan fitur P1/P2 seperti notifikasi email.

## 6. Checklist Sebelum Submit

- [ ] Export database final ke `database/study_group_organizer.sql`
- [ ] Push seluruh kode (termasuk `/library` dan file `.sql`) ke GitHub
- [ ] Pastikan `config/database.php` tidak mengandung kredensial sensitif asli (gunakan contoh `root`/kosong agar aman dipublikasikan)
- [ ] Rekam video presentasi ≤10 menit, upload ke YouTube (Unlisted), cantumkan URL GitHub di deskripsi video
- [ ] Susun laporan PDF: deskripsi project, screenshot tiap fitur (urut sesuai `FEATURES.md`), screenshot struktur database, URL GitHub, URL video
