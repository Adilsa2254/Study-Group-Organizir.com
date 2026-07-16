# Library Pihak Ketiga

Folder ini menyimpan library PHP pihak ketiga yang ditambahkan **secara manual** (tanpa Composer), sesuai requirement soal UAS yang mewajibkan native PHP.

Catat setiap library yang ditambahkan di tabel berikut:

| Nama Library | Versi | Sumber (URL) | Digunakan Untuk | Tanggal Ditambahkan |
|---|---|---|---|---|
| **FPDF** | 1.86 | http://www.fpdf.org/ | Mencetak laporan data / daftar anggota menjadi PDF | 16 Juli 2026 |
| **Parsedown** | 1.8.0 | https://github.com/erusev/parsedown | Mem-parsing Markdown (***bold***, dll) pada deskripsi kelompok | 16 Juli 2026 |

## Cara Menambah Library Baru

1. Unduh source dari repository resmi (mode "Download ZIP", bukan lewat package manager).
2. Ekstrak ke `library/{NamaLibrary}/`.
3. `require_once` file yang dibutuhkan dari controller/model terkait.
4. Tambahkan satu baris ke tabel di atas.

Lihat `../INSTALLATION.md` bagian 5 untuk contoh lengkap dan rekomendasi library.
