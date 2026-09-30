<?php
require_once "config/database.php";

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     ORDER BY id DESC
     LIMIT 6"
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOA Coffee - From the Land of the Nusantara</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="index.php">DOA <span>COFFEE</span></a>
        <div class="nav-links">
            <a href="index.php">Beranda</a>
            <a href="produk.php">Katalog</a>
            <a href="tentang.php">Tentang Kami</a>
            <a class="nav-admin" href="auth/login.php">Admin</a>
        </div>
    </div>
</div>

<section class="hero">
    <div class="container hero-content">
        <p class="eyebrow">THREE MOUNTAINS. ONE ORIGIN. ONE STORY.</p>
        <h1>Secangkir Kopi<br><span>Menginspirasi.</span></h1>
        <p>
            Dari pegunungan Argopuro, Jawa Timur, Doa Coffee menghadirkan
            kopi dengan proses yang terkontrol, asal-usul yang jelas,
            dan cita rasa yang konsisten.
        </p>
        <div class="hero-actions">
            <a href="produk.php" class="btn">Lihat Katalog</a>
            <a href="tentang.php" class="btn btn-outline">Cerita Doa Coffee</a>
        </div>
    </div>
</section>

<section class="story-strip">
    <div class="container info-grid">
        <div>
            <strong>2014</strong>
            <span>Didirikan di wilayah Argopuro</span>
        </div>
        <div>
            <strong>100%</strong>
            <span>Pengelolaan dari kebun hingga pascapanen</span>
        </div>
        <div>
            <strong>85</strong>
            <span>Cupping score Wine Coffee yang tercantum pada materi brand</span>
        </div>
    </div>
</section>

<div class="container section">
    <div class="section-heading">
        <div>
            <p class="eyebrow">OUR COFFEE</p>
            <h2>Produk Pilihan</h2>
        </div>
        <a href="produk.php" class="text-link">Lihat semua →</a>
    </div>

    <div class="grid">
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <div class="card product-card">
            <?php if ($row['gambar']): ?>
                <img src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>"
                     class="product-image" alt="<?= htmlspecialchars($row['nama']); ?>">
            <?php endif; ?>

            <div class="product-body">
                <p class="category"><?= htmlspecialchars($row['kategori']); ?></p>
                <h3><?= htmlspecialchars($row['nama']); ?></h3>
                <p><?= htmlspecialchars($row['deskripsi']); ?></p>
                <div class="product-bottom">
                    <strong>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></strong>
                    <a href="detail.php?id=<?= $row['id']; ?>" class="btn small">Detail</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<footer>
    <div class="container footer-inner">
        <div>
            <div class="brand">DOA <span>COFFEE</span></div>
            <p>From the Land of the Nusantara, for the World.</p>
        </div>
        <div>
            <p>WhatsApp: 085221224989 / 085232467121</p>
            <p>Instagram: @doacoffee_official</p>
        </div>
    </div>
</footer>

</body>
</html>
