# DOA Coffee CRUD

Versi modifikasi dari project CRUD `toko_kue` dengan struktur folder dan alur CRUD yang dipertahankan, tetapi tema, data, katalog, dan tampilan diubah menjadi DOA Coffee.

## Struktur

```text
doa_coffee_crud/
├── admin/
│   ├── edit.php
│   ├── hapus.php
│   ├── index.php
│   ├── logout.php
│   ├── proses_produk.php
│   ├── produk.php
│   └── tambah.php
├── assets/
│   └── style.css
├── auth/
│   ├── login.php
│   └── proses_login.php
├── config/
│   └── database.php
├── includes/
│   ├── auth.php
│   └── flash.php
├── uploads/
│   └── produk/
├── detail.php
├── index.php
├── produk.php
├── tentang.php
├── doa_coffee.sql
└── README.md
```

## Cara menjalankan

1. Ekstrak folder `doa_coffee_crud` ke `C:/xampp/htdocs/`.
2. Jalankan Apache dan MySQL di XAMPP.
3. Buka `http://localhost/phpmyadmin`.
4. Import `doa_coffee.sql`.
5. Pastikan database yang dipakai adalah `doa_coffee`.
6. Buka `http://localhost/doa_coffee_crud/`.
7. Login admin melalui tombol Admin.

### Akun admin
- Username: `admin`
- Password: `admin`

## Catatan data

Informasi brand, produk, harga, kontak, visi/misi, proses, dan metode pengolahan diambil dari dokumen DOA Coffee yang diberikan. Kolom stok adalah bagian dari struktur CRUD dosen; katalog sumber tidak memberikan angka stok, sehingga stok awal diisi `0` dan bisa diubah dari dashboard.

## Fitur

- Halaman beranda DOA Coffee.
- Katalog produk.
- Pencarian dan filter kategori.
- Detail produk.
- Login admin.
- Dashboard.
- Create, Read, Update, Delete produk.
- Upload gambar produk.
- Pagination.
- Tema coklat dan hitam.
