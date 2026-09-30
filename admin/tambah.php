<?php
session_start();
require_once "../includes/auth.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - DOA Coffee</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="index.php">DOA <span>COFFEE</span></a>
        <div class="nav-links">
            <a href="index.php">Dashboard</a>
            <a href="produk.php">Produk</a>
        </div>
    </div>
</div>

<div class="container section">
    <div class="card form-card">
        <p class="eyebrow">CREATE</p>
        <h1>Tambah Produk Kopi</h1>
        <?php include "../includes/flash.php"; ?>

        <form action="proses_produk.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="tambah">

            <label>Nama Produk</label>
            <input type="text" name="nama" required>

            <label>Kategori</label>
            <select name="kategori" required>
                <option value="">Pilih kategori</option>
                <option value="Robusta">Robusta</option>
                <option value="Arabika Wine">Arabika Wine</option>
                <option value="Arabika Natural">Arabika Natural</option>
                <option value="Arabika Fullwash">Arabika Fullwash</option>
                <option value="Arabika Yellow Caturra">Arabika Yellow Caturra</option>
                <option value="Luwak Arabica">Luwak Arabica</option>
                <option value="Excelsa">Excelsa</option>
            </select>

            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="6" required></textarea>

            <label>Harga</label>
            <input type="number" name="harga" min="0" required>

            <label>Stok</label>
            <input type="number" name="stok" min="0" value="0" required>

            <label>Gambar Produk</label>
            <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp">

            <div class="form-actions">
                <button type="submit" class="btn">Simpan Produk</button>
                <a href="produk.php" class="btn btn-outline">Kembali</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
