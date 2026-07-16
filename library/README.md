# Library Pihak Ketiga

Folder ini menyimpan library PHP pihak ketiga yang ditambahkan **secara manual** (tanpa Composer), sesuai requirement soal UAS yang mewajibkan native PHP.

Catat setiap library yang ditambahkan di tabel berikut:

| Nama Library | Versi | Sumber (URL) | Digunakan Untuk | Tanggal Ditambahkan |
|---|---|---|---|---|
| _(belum ada)_ | | | | |

## Cara Menambah Library Baru

1. Unduh source dari repository resmi (mode "Download ZIP", bukan lewat package manager).
2. Ekstrak ke `library/{NamaLibrary}/`.
3. `require_once` file yang dibutuhkan dari controller/model terkait.
4. Tambahkan satu baris ke tabel di atas.

Lihat `../INSTALLATION.md` bagian 5 untuk contoh lengkap dan rekomendasi library.
