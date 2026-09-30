<?php
require_once "../includes/auth.php";
require_once "../config/database.php";

$total_produk = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM produk"
);
$data_produk = mysqli_fetch_assoc($total_produk);

$total_kategori = mysqli_query(
    $conn,
    "SELECT COUNT(DISTINCT kategori) AS total FROM produk"
);
$data_kategori = mysqli_fetch_assoc($total_kategori);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - DOA Coffee</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="index.php">DOA <span>COFFEE</span></a>
        <div class="nav-links">
            <a href="index.php">Dashboard</a>
            <a href="produk.php">Produk</a>
            <a href="../index.php">Website</a>
            <a class="nav-admin" href="logout.php">Logout</a>
        </div>
    </div>
</div>

<div class="container section">
    <p class="eyebrow">ADMIN AREA</p>
    <h1>Dashboard Doa Coffee</h1>
    <p>Selamat datang, <strong><?= htmlspecialchars($_SESSION['admin_nama']); ?></strong>.</p>

    <div class="grid stats-grid">
        <div class="card stat-card">
            <span>Total Produk</span>
            <strong><?= $data_produk['total']; ?></strong>
        </div>
        <div class="card stat-card">
            <span>Total Kategori</span>
            <strong><?= $data_kategori['total']; ?></strong>
        </div>
        <div class="card stat-card">
            <span>Status Sistem</span>
            <strong>Aktif</strong>
        </div>
    </div>

    <div class="card">
        <p class="eyebrow">CATALOG MANAGEMENT</p>
        <h2>Manajemen Produk</h2>
        <p>Tambah, edit, hapus, cari, dan filter katalog kopi Doa Coffee.</p>
        <a href="produk.php" class="btn">Kelola Produk</a>
    </div>
</div>

</body>
</html>
