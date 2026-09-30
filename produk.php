<?php
require_once "config/database.php";

$keyword = $_GET['keyword'] ?? '';
$kategori = $_GET['kategori'] ?? '';

$where = [];

if ($keyword != '') {
    $keyword_safe = mysqli_real_escape_string($conn, $keyword);
    $where[] = "nama LIKE '%$keyword_safe%'";
}

if ($kategori != '') {
    $kategori_safe = mysqli_real_escape_string($conn, $kategori);
    $where[] = "kategori = '$kategori_safe'";
}

$where_sql = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     $where_sql
     ORDER BY id DESC"
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kopi - DOA Coffee</title>
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

<div class="container section">
    <div class="section-heading">
        <div>
            <p class="eyebrow">DIGITAL CATALOG</p>
            <h1>Katalog Kopi</h1>
            <p class="lead">Pilih kopi berdasarkan jenis dan karakter yang ingin kamu eksplorasi.</p>
        </div>
    </div>

    <div class="card filter-card">
        <form method="GET" class="filter-form">
            <div>
                <label>Cari Produk</label>
                <input type="text" name="keyword" placeholder="Cari nama kopi..."
                       value="<?= htmlspecialchars($keyword); ?>">
            </div>
            <div>
                <label>Kategori</label>
                <select name="kategori">
                    <option value="">Semua Kategori</option>
                    <?php
                    $kategori_list = [
                        "Robusta", "Arabika Wine", "Arabika Natural",
                        "Arabika Fullwash", "Arabika Yellow Caturra",
                        "Luwak Arabica", "Excelsa"
                    ];
                    foreach ($kategori_list as $item):
                    ?>
                        <option value="<?= htmlspecialchars($item); ?>"
                            <?= $kategori == $item ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($item); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn">Cari</button>
        </form>
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
                <h3 class="price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></h3>
                <a href="detail.php?id=<?= $row['id']; ?>" class="btn">Lihat Detail</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
