<?php
session_start();
require_once "../includes/auth.php";
require_once "../config/database.php";

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
    <title>Edit Produk - DOA Coffee</title>
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
        <p class="eyebrow">UPDATE</p>
        <h1>Edit Produk Kopi</h1>
        <?php include "../includes/flash.php"; ?>

        <form action="proses_produk.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="edit">
            <input type="hidden" name="id" value="<?= $produk['id']; ?>">

            <label>Nama Produk</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($produk['nama']); ?>" required>

            <label>Kategori</label>
            <select name="kategori" required>
                <?php
                $kategori_list = [
                    "Robusta", "Arabika Wine", "Arabika Natural",
                    "Arabika Fullwash", "Arabika Yellow Caturra",
                    "Luwak Arabica", "Excelsa"
                ];
                foreach ($kategori_list as $item):
                ?>
                <option value="<?= htmlspecialchars($item); ?>"
                    <?= $produk['kategori'] == $item ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($item); ?>
                </option>
                <?php endforeach; ?>
            </select>

            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="6" required><?= htmlspecialchars($produk['deskripsi']); ?></textarea>

            <label>Harga</label>
            <input type="number" name="harga" value="<?= $produk['harga']; ?>" min="0" required>

            <label>Stok</label>
            <input type="number" name="stok" value="<?= $produk['stok']; ?>" min="0" required>

            <label>Ganti Gambar</label>
            <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp">

            <?php if ($produk['gambar']): ?>
                <p>Gambar saat ini:</p>
                <img src="../uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>"
                     class="preview-image" alt="Gambar produk">
            <?php endif; ?>

            <div class="form-actions">
                <button type="submit" class="btn">Update Produk</button>
                <a href="produk.php" class="btn btn-outline">Kembali</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
