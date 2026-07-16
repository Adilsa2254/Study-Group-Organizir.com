Tugas Kuliah Mahasiswa <span style="float: right;">Juli 2026</span>

**Dokumentasi**<br>
**Project Pemrograman Web**

---

Nama : Adil Saputra<br>
Nim : 241110038<br>
Matkul : Pemrograman Web<br>
Kelas : 12D

### Study Group Organizer

Proyek ini dibuat berdasarkan studi kasus nyata untuk mengatasi permasalahan yang sering dialami oleh para mahasiswa dan pelajar. Banyak pelajar kesulitan menemukan ruang digital yang rapi dan interaktif untuk membentuk kelompok belajar, mengatur jadwal, serta mengorganisasikan materi secara terstruktur di luar grup obrolan (chat) konvensional yang sering tertumpuk.

Project web ini dibangun dengan konsep **SaaS (Software as a Service)** untuk menyelesaikan masalah tersebut. Dengan antarmuka yang terinspirasi dari desain modern yang bersih dan intuitif, platform ini memungkinkan siswa untuk membuat kelompok belajar (Study Groups) berdasarkan mata pelajaran, mengunggah dan membagikan materi, berdiskusi melalui komentar, dan mengelola jadwal pertemuan belajar secara efisien.

**URL Project**

🌐 : https://study-group-organizir.com
🐙 : https://github.com/Adilsa2254/Study-Group-Organizir.com
▶️ : https://youtu.be/contoh_presentasi_uas

---

### 1. Fitur yang ada pada platform.

**a. Eksplorasi Kelompok Belajar (Groups)**
Menampilkan daftar kelompok belajar yang bisa diikuti berdasarkan mata pelajaran dengan tata letak visual berupa *Cards* yang dinamis dan sangat responsif terhadap ukuran layar.

**b. Autentikasi Pengguna & Manajemen Profil**
Sistem pendaftaran, *login*, dan *register* yang aman. Dilengkapi dengan manajemen profil komprehensif di mana pengguna dapat menyesuaikan nama, email, hingga mengunggah foto profil (Avatar) mereka sendiri.

**c. Sistem Materi & Diskusi**
Pengguna dapat mengunggah (upload) file referensi berformat PDF/DOCX ke dalam sistem kelompok belajar. Tersedia pula fitur interaksi sosial di mana anggota bisa memberikan komentar, berdiskusi pada materi terkait, lengkap dengan tampilan foto profil masing-masing.

**d. Export Laporan Data (PDF & Excel)**
Fitur analitik dan dokumentasi di mana pembuat kelompok (atau admin) dapat mem-parsing anggota kelompok belajar menjadi laporan berformat PDF dan dokumen Microsoft Excel (.xlsx) dengan sekali klik.

**e. Dukungan Penulisan Markdown**
Deskripsi setiap kelompok mendukung format penulisan *Markdown*. Fitur ini menyulap teks biasa menjadi format yang tebal, miring, hingga daftar poin-poin secara instan.

**f. Dashboard Berdasarkan Peran (Role-Based Access)**
Menyajikan panel kontrol (*Dashboard*) yang secara cerdas mendeteksi apakah pengguna yang masuk adalah seorang Administrator (mengakses manajemen pengguna dan metrik global) atau seorang Siswa (fokus pada kelas dan aktivitas).

---

### 2. Tech Stack.
Aplikasi ini dibangun menggunakan tumpukan teknologi berikut yang memastikan performa cepat, tanpa *overhead* kerangka kerja besar, yaitu:

**a. Front End**
- **Bootstrap 5**: Framework CSS *utility-first* yang digunakan untuk *styling* super cepat, penyusunan tata letak, dan responsivitas desain.
- **Vanilla Javascript**: Skrip ringan untuk menangani interaksi langsung pada browser tanpa membebani muatan halaman.
- **Bootstrap Icons**: Menggunakan perpustakaan ikon SVG elegan untuk meningkatkan pengalaman visual antarmuka pengguna (UI).

**b. Backend & Infrastruktur**
- **PHP (Native)**: Karena berbasis pada mata kuliah Pemrograman Web tingkat lanjut, proyek ini murni dibangun menggunakan bahasa perograman PHP asli. Mengadopsi arsitektur **MVC (Model-View-Controller)** yang di-routing secara mandiri *(Front Controller)* tanpa bergantung pada kerangka kerja (framework) besar seperti Laravel.
- **XAMPP (Apache)**: Sebagai infrastruktur web *server* lokal yang efisien.

**c. Database**
- **MySQL (MariaDB)**: Digunakan murni sebagai layanan *hosting database* relasional untuk menampung tabel pengguna, kelompok, materi, jadwal, hingga komentar, lalu menghubungkannya (melalui relasi) ke backend aplikasi.

**d. Library Eksternal (Third-Party Libraries)**
- **FPDF**: Library utilitas PHP untuk membangun dan menyusun dokumen file PDF langsung dari kumpulan *database*.
- **SimpleXLSXGen**: Library PHP yang sangat ringan untuk membuat (generate) berkas rekapan *spreadsheet* berformat `Excel` (.xlsx).
- **Parsedown**: Library *parser* (penerjemah) tingkat lanjut untuk mengubah penulisan Markdown pengguna menjadi elemen HTML visual yang rapi.

---

### 3. Struktur directory utama project (Root Project).

```text
Study-Group-Organizir(uas)/
├── config/             # Seluruh file konfigurasi aplikasi (Database & Env)
├── controllers/        # Logika utama aplikasi backend penghubung view & model
├── library/            # Direktori tempat library eksternal manual (FPDF, Parsedown)
├── models/             # File representasi kueri (query) database (CRUD tables)
├── Project/            # Referensi dokumentasi teknis & ERD
├── uploads/            # Berkas upload direktori dinamis (Materi dan Profil Foto)
│   ├── materials/      # File unggahan dokumen kelompok belajar
│   └── profiles/       # File unggahan gambar avatar
├── views/              # Kode sumber HTML/PHP untuk antarmuka frontend (Pages, Layouts)
│   ├── admin/          # Tampilan manajemen dasbor admin
│   ├── auth/           # Komponen pendaftaran dan autentikasi
│   ├── groups/         # Komponen UI Masonry Cards Kelompok
│   ├── layouts/        # Template master (header.php, navbar.php, footer.php)
│   ├── profile/        # Komponen manajemen akun
│   └── student/        # Tampilan personalisasi siswa
├── index.php           # File titik masuk utama routing aplikasi (Front Controller)
└── setup_db.sql        # Skema database awal, relasi, beserta data pancingan
```