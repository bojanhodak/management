# 📦 Sistem Informasi Rental (Laravel 13)

Sistem Informasi Manajemen Rental berbasis web yang dibangun menggunakan **Laravel 13** dan **Bootstrap 5**. Aplikasi ini dirancang untuk mengelola seluruh operasional penyewaan barang/alat, mulai dari autentikasi berbasis role, manajemen data master, transaksi penyewaan dengan penyesuaian stok otomatis, hingga pelaporan pendapatan.

---

## 🎓 Identitas Pengembang & Tugas

Proyek ini dibuat dan dikembangkan untuk memenuhi tugas **Ulangan Akhir Semester (UAS)**:

- **Nama** : Muhamad Hilman
- **NIM** : 250220266
- **Program Studi** : Manajemen Informatika
- **Mata Kuliah** : Pemrograman Web 2
- **Dosen Pengampu** : Syifa Shintawati, S.Kom

---

## 🚀 Fitur Utama

### 1. 🔐 Autentikasi & Multi-Role (RBAC)

- **Login & Auth System**: Autentikasi pengguna menggunakan model custom (`Anggota`).
- **Hak Akses Berbasis Role (`RoleMiddleware`)**:
    - **Administrator & Staff**: Akses penuh ke seluruh sistem (Dashboard, Data Master, Transaksi, dan Laporan).
    - **Customer / User**: Akses terbatas pada modul transaksi penyewaan.

### 2. 🗂️ Manajemen Data Master (CRUD)

- **Kategori Barang**: Pengelompokan jenis alat/barang rental.
- **Barang / Alat**: Inventarisasi barang lengkap dengan harga sewa per hari dan pantauan stok real-time.
- **Supplier**: Pengelolaan data pemasok barang.
- **Pelanggan**: Pendataan pelanggan penyewa.
- **Anggota / Pengguna**: Pengelolaan akun pengguna dan penetapan role.

### 3. 🔄 Transaksi Penyewaan & Stok Otomatis

- **Otomatisasi Stok Alat**:
    - Mengubah status transaksi ke **Disewa** akan **memotong stok** barang secara otomatis.
    - Mengubah status transaksi ke **Dikembalikan / Selesai** akan **mengembalikan stok** barang.
- **Kalkulasi Biaya Otomatis**: Perhitungan otomatis estimasi total biaya sewa berbasis tarif barang dan durasi sewa (JavaScript).
- **Filter & Pencarian**: Filter transaksi berdasarkan Kode Transaksi, Nama Pelanggan, atau Status Sewa.

### 4. 📊 Modul Pelaporan (Reporting)

- **Filter Rentang Tanggal**: Menampilkan rekapitulasi transaksi berdasarkan rentang tanggal tertentu.
- **Kalkulasi Pendapatan**: Total akumulasi pendapatan sewa secara otomatis.
- **Print Ready**: Tampilan khusus yang dioptimalkan untuk cetak laporan (`window.print()`).

---

## 🛠️ Tumpukan Teknologi (Tech Stack)

- **Framework Backend**: Laravel 13.x
- **Bahasa Pemrograman**: PHP >= 8.2
- **Database**: MySQL / MariaDB
- **ORM**: Eloquent ORM
- **Frontend / UI**: HTML5, CSS3, JavaScript (ES6), Bootstrap 5
- **Architecture**: Model-View-Controller (MVC)

---
