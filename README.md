# Study Group Organizer

Proyek ini dibangun berdasarkan studi kasus nyata untuk mengatasi permasalahan yang sering dialami oleh para mahasiswa dan pelajar. Banyak pelajar kesulitan menemukan ruang digital yang rapi dan interaktif untuk membentuk kelompok belajar, mengatur jadwal, serta mengorganisasikan materi secara terstruktur di luar grup obrolan (chat) konvensional yang sering tertumpuk.

Project web ini mengadopsi konsep **SaaS (Software as a Service)**. Dengan antarmuka modern, bersih, dan intuitif, platform ini memungkinkan siswa untuk membuat kelompok belajar (Study Groups) berdasarkan mata pelajaran, mengunggah dan membagikan materi, berdiskusi melalui komentar, dan mengelola jadwal pertemuan belajar secara efisien.

**URL Project**
- 🌐 : https://study-group-organizir.com
- 🐙 : https://github.com/Adilsa2254/Study-Group-Organizir.com
- ▶️ : https://youtu.be/contoh_presentasi_uas

---

## 🛠️ Tech Stack

Aplikasi ini dibangun menggunakan tumpukan teknologi berikut yang memastikan performa cepat tanpa *overhead* kerangka kerja besar:

**Front End**
- **Bootstrap 5**: Framework CSS untuk *styling* cepat dan responsivitas desain.
- **Vanilla Javascript**: Skrip ringan untuk interaksi langsung pada browser.
- **Bootstrap Icons**: Ikon SVG elegan untuk antarmuka pengguna.

**Backend & Infrastruktur**
- **PHP (Native)**: Murni dibangun menggunakan PHP. Mengadopsi arsitektur **MVC (Model-View-Controller)** dengan *Front Controller* tanpa bergantung pada framework besar.
- **XAMPP (Apache)**: Infrastruktur web *server* lokal yang efisien.

**Database**
- **MySQL (MariaDB)**: Database relasional untuk menampung data pengguna, kelompok, materi, jadwal, hingga komentar.

**Library Eksternal (Third-Party Libraries)**
- **FPDF**: Membuat file PDF langsung dari *database*.
- **SimpleXLSXGen**: Membuat berkas *spreadsheet* berformat Excel (.xlsx).
- **Parsedown**: *Parser* untuk mengubah penulisan Markdown menjadi HTML.

---

## ✨ Fitur Utama

- **Eksplorasi Kelompok Belajar**: Daftar kelompok belajar dengan tata letak *Cards* dinamis dan responsif.
- **Autentikasi & Manajemen Profil**: Sistem *login*, *register*, dan pengaturan profil pengguna (termasuk upload avatar).
- **Sistem Materi & Diskusi**: Unggah file (PDF/DOCX) dan fitur komentar interaktif antar anggota.
- **Export Laporan (PDF & Excel)**: Admin dapat mem-parsing data anggota kelompok belajar menjadi laporan PDF/Excel.
- **Dukungan Markdown**: Penulisan deskripsi mendukung Markdown agar lebih rapi (tebal, miring, list).
- **Role-Based Access (Dashboard)**: Tampilan dasbor yang disesuaikan berdasarkan peran (Admin atau Siswa).

---

## 🚀 Cara Instalasi Project

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek secara lokal di komputer Anda:

### Prasyarat
- Pastikan Anda telah menginstal **XAMPP** (dengan PHP versi 7.4 atau lebih baru).
- Git (opsional, jika Anda ingin melakukan *clone*).

### Langkah-langkah instalasi

1. **Clone atau Unduh Repository**
   - Lakukan clone menggunakan terminal:
     ```bash
     git clone https://github.com/Adilsa2254/Study-Group-Organizir.com.git
     ```
   - Atau unduh file ZIP dan ekstrak.

2. **Pindahkan Folder Project**
   - Ubah nama folder hasil ekstrak menjadi `Study-Group-Organizir(uas)` (atau sesuai nama folder saat ini).
   - Pindahkan folder tersebut ke dalam direktori `htdocs` pada instalasi XAMPP Anda.
     - Windows: `C:\xampp\htdocs\`
     - Mac: `/Applications/XAMPP/htdocs/`
     - Linux: `/opt/lampp/htdocs/`

3. **Konfigurasi Database**
   - Buka aplikasi **XAMPP Control Panel** dan jalankan layanan **Apache** dan **MySQL**.
   - Buka browser dan akses **phpMyAdmin** melalui URL: `http://localhost/phpmyadmin`
   - Buat database baru (misalnya dengan nama `study_group_db`).
   - Impor (Import) file `setup_db.sql` yang berada di *root* folder proyek ke dalam database yang baru Anda buat. File ini berisi struktur tabel dan data awal.

4. **Konfigurasi Aplikasi**
   - Buka file konfigurasi database di `config/database.php` menggunakan teks editor.
   - Sesuaikan kredensial database (username, password, dan nama database) jika Anda menggunakan konfigurasi MySQL yang berbeda dari bawaan XAMPP.
     ```php
     $host = 'localhost';
     $dbname = 'nama_database_anda'; // Sesuaikan dengan nama DB di langkah 3
     $username = 'root'; // Bawaan XAMPP biasanya root
     $password = ''; // Bawaan XAMPP biasanya dikosongkan
     ```

5. **Jalankan Aplikasi**
   - Buka web browser Anda.
   - Akses URL aplikasi lokal Anda (sesuaikan dengan nama folder di htdocs):
     ```text
     http://localhost/Study-Group-Organizir(uas)
     ```
   - Aplikasi siap digunakan!

---

## 📁 Struktur Direktori

```text
Study-Group-Organizir(uas)/
├── config/             # File konfigurasi aplikasi (Database & Env)
├── controllers/        # Logika utama (Controller MVC)
├── library/            # Library eksternal manual (FPDF, Parsedown)
├── models/             # Representasi kueri database (Model MVC)
├── Project/            # Referensi dokumentasi teknis & ERD
├── uploads/            # Direktori file unggahan
│   ├── materials/      # Dokumen materi kelompok
│   └── profiles/       # Gambar profil/avatar pengguna
├── views/              # Tampilan antarmuka HTML/PHP (View MVC)
├── index.php           # Entry point utama (Front Controller)
└── setup_db.sql        # Skema database awal
```