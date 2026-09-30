<?php
require_once "config/database.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk WHERE id = $id"
);

$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    die("Produk tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produk['nama']); ?> - DOA Coffee</title>
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
        </div>
    </div>
</div>

<div class="container section">
    <div class="detail-card card">
        <div>
            <?php if ($produk['gambar']): ?>
                <img src="uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>"
                     class="detail-image" alt="<?= htmlspecialchars($produk['nama']); ?>">
            <?php endif; ?>
        </div>

        <div class="detail-content">
            <p class="category"><?= htmlspecialchars($produk['kategori']); ?></p>
            <h1><?= htmlspecialchars($produk['nama']); ?></h1>
            <p class="detail-description"><?= nl2br(htmlspecialchars($produk['deskripsi'])); ?></p>

            <div class="spec-box">
                <p><span>Net Weight</span> 200 gr</p>
                <p><span>Roasting</span> Medium-Dark Roast</p>
                <p><span>Stok</span> <?= (int)$produk['stok']; ?></p>
            </div>

            <h2 class="price">Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></h2>

            <div class="detail-actions">
                <a href="https://wa.me/6285221224989?text=Halo%20DOA%20Coffee,%20saya%20tertarik%20dengan%20<?= urlencode($produk['nama']); ?>"
                   class="btn" target="_blank">Pesan via WhatsApp</a>
                <a href="produk.php" class="btn btn-outline">Kembali</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
