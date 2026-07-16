# Study Group Organizer

Aplikasi web kolaboratif yang membantu siswa membentuk kelompok belajar sesuai minat mata pelajaran, mengatur jadwal belajar bersama, berbagi catatan/materi, serta terhubung dengan sesama siswa maupun mentor — dibangun untuk memenuhi tugas UAS **Praktikum Pemrograman Web** (Native PHP + MySQL + Bootstrap/Tailwind).

## Dokumen di Folder Ini

Baca dokumen berikut **sesuai urutan** sebelum mulai coding (terutama jika kamu memakai AI coding agent seperti Claude Code):

| Urutan | File | Isi |
|---|---|---|
| 1 | [`PRD.md`](./PRD.md) | Latar belakang, tujuan, ruang lingkup, requirement fungsional & non-fungsional |
| 2 | [`FEATURES.md`](./FEATURES.md) | Daftar fitur wajib (MVP) vs opsional, prioritas pengerjaan |
| 3 | [`DATABASE_SCHEMA.md`](./DATABASE_SCHEMA.md) | ERD + skema tabel MySQL lengkap (DDL) |
| 4 | [`FOLDER_STRUCTURE.md`](./FOLDER_STRUCTURE.md) | Penjelasan tiap folder & konvensi penamaan file |
| 5 | [`INSTALLATION.md`](./INSTALLATION.md) | Cara setup lokal (XAMPP/Laragon), import DB, menambah library |
| 6 | [`CLAUDE.md`](./CLAUDE.md) | Instruksi khusus untuk AI coding agent — baca ini duluan jika kamu delegasikan coding ke AI |

## Ringkasan Cepat

- **Tema**: Study Group Organizer
- **Stack**: Native PHP (tanpa framework), MySQL, Bootstrap 5 (rekomendasi), vanilla JS
- **Pola arsitektur**: MVC manual (Model–View–Controller) dengan front controller sederhana
- **Library pihak ketiga**: disimpan manual di folder `/library` (lihat `INSTALLATION.md`)
- **Target nilai**: Memenuhi 100% requirement wajib CRUD dari soal, ditambah fitur tema secukupnya sebagai nilai plus

## Struktur Direktori (ringkas)

```
/study-group-organizer
├── /assets        → css, js, images
├── /config         → koneksi database & konfigurasi app
├── /controllers    → logic tiap modul (auth, group, schedule, material, dst)
├── /models         → representasi tabel & query database
├── /library        → third-party PHP library (manual, tanpa Composer)
├── /uploads        → file materi/dokumen yang diupload user
└── /views          → tampilan (admin, auth, groups, layouts)
```

Detail lengkap ada di `FOLDER_STRUCTURE.md`.
