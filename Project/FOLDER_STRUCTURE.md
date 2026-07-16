# Folder Structure — Study Group Organizer

Struktur ini mengikuti pola **MVC manual** (tanpa framework), sesuai kerangka yang sudah ditentukan sebelumnya, ditambah satu folder `/library` untuk menyimpan library PHP pihak ketiga secara manual (tanpa Composer).

```
/study-group-organizer
├── index.php                  → front controller / router utama
├── .htaccess                  → URL rewriting (opsional, jika pakai Apache)
├── /assets
│   ├── /css                   → custom.css (override Bootstrap/Tailwind bila perlu)
│   ├── /js                    → script AJAX (comment, chat polling, dsb), validasi form
│   └── /images                → logo, ikon, gambar statis
├── /config
│   ├── database.php           → koneksi PDO ke MySQL
│   └── config.php             → konstanta umum (BASE_URL, UPLOAD_PATH, dsb)
├── /controllers
│   ├── AuthController.php     → register, login, logout
│   ├── UserController.php     → CRUD users (admin)
│   ├── SubjectController.php  → CRUD mata pelajaran (admin)
│   ├── GroupController.php    → CRUD kelompok belajar + join/leave
│   ├── ScheduleController.php → CRUD jadwal belajar
│   ├── MaterialController.php → CRUD materi/catatan (upload/hapus file)
│   └── CommentController.php  → CRUD komentar
├── /models
│   ├── User.php
│   ├── Subject.php
│   ├── StudyGroup.php
│   ├── GroupMember.php
│   ├── Schedule.php
│   ├── Material.php
│   └── Comment.php
├── /library
│   ├── README.md               → daftar & versi library yang dipakai (lihat INSTALLATION.md)
│   └── (contoh) PHPMailer/      → library pihak ketiga disalin manual ke sini, lalu di-require_once
├── /uploads
│   └── materials/               → file materi hasil upload user (disimpan by group_id/timestamp)
└── /views
    ├── /layouts
    │   ├── header.php
    │   ├── navbar.php
    │   └── footer.php
    ├── /auth
    │   ├── login.php
    │   └── register.php
    ├── /admin
    │   ├── dashboard.php
    │   ├── users_index.php / users_form.php
    │   └── subjects_index.php / subjects_form.php
    └── /groups
        ├── index.php            → daftar kelompok belajar
        ├── show.php             → detail kelompok (jadwal, materi, komentar)
        ├── form.php             → form create/edit kelompok
        ├── schedules_form.php
        └── materials_form.php
```

## Konvensi Penamaan

- **Controller**: `PascalCase` + suffix `Controller.php`, satu file per modul/entitas.
- **Model**: `PascalCase.php`, nama singular sesuai entitas (`Schedule.php`, bukan `Schedules.php`).
- **View**: `snake_case.php`, dikelompokkan per modul di sub-folder `/views`.
- **File upload**: disimpan dengan pola `uploads/materials/{group_id}_{timestamp}_{nama_file_asli}` untuk menghindari bentrok nama file.

## Alur Request (Front Controller Sederhana)

`index.php` menerima parameter `?page=` (atau route via `.htaccess`), lalu memanggil controller yang sesuai:

```php
// index.php (contoh pola sederhana)
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'login':
        require 'controllers/AuthController.php';
        break;
    case 'groups':
        require 'controllers/GroupController.php';
        break;
    case 'schedules':
        require 'controllers/ScheduleController.php';
        break;
    // ... modul lain
    default:
        http_response_code(404);
        require 'views/errors/404.php';
}
```

Setiap controller bertanggung jawab membaca `$_SERVER['REQUEST_METHOD']` untuk membedakan aksi (GET = tampilkan data/form, POST = simpan/update/hapus), memanggil Model yang sesuai, lalu me-render View yang tepat.

## Kenapa Folder `/library` Ditambahkan?

Soal mewajibkan **native PHP**, sehingga proyek ini **tidak menggunakan Composer**. Jika suatu saat butuh library pihak ketiga (misalnya PHPMailer untuk notifikasi email, atau Dompdf untuk export PDF), library tersebut **diunduh manual** (bukan lewat `composer require`) dan diletakkan di `/library/{NamaLibrary}/`, lalu di-include lewat `require_once` di file yang membutuhkan. Detail langkah ada di `INSTALLATION.md`.
