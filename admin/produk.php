<?php
session_start();
require_once "../includes/auth.php";
require_once "../config/database.php";

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

$per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$offset = ($page - 1) * $per_page;

$count_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM produk $where_sql"
);
$count_data = mysqli_fetch_assoc($count_query);
$total_data = $count_data['total'];
$total_page = ceil($total_data / $per_page);

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     $where_sql
     ORDER BY id DESC
     LIMIT $per_page OFFSET $offset"
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - DOA Coffee</title>
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
        </div>
    </div>
</div>

<div class="container section">
    <p class="eyebrow">CRUD CATALOG</p>
    <div class="section-heading">
        <div>
            <h1>Kelola Produk</h1>
            <p class="lead">Kelola data katalog kopi Doa Coffee.</p>
        </div>
        <a href="tambah.php" class="btn">+ Tambah Produk</a>
    </div>

    <?php include "../includes/flash.php"; ?>

    <div class="card filter-card">
        <form method="GET" class="filter-form">
            <div>
                <label>Cari Produk</label>
                <input type="text" name="keyword" placeholder="Masukkan nama kopi"
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

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td>
                        <?php if ($row['gambar']): ?>
                            <img class="table-image"
                                 src="../uploads/produk/<?= htmlspecialchars($row['gambar']); ?>"
                                 alt="<?= htmlspecialchars($row['nama']); ?>">
                        <?php endif; ?>
                    </td>
                    <td>
                        <strong><?= htmlspecialchars($row['nama']); ?></strong>
                        <small><?= htmlspecialchars($row['deskripsi']); ?></small>
                    </td>
                    <td><?= htmlspecialchars($row['kategori']); ?></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><?= (int)$row['stok']; ?></td>
                    <td class="actions">
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn small">Edit</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>"
                           class="btn small btn-danger"
                           onclick="return confirm('Yakin ingin menghapus produk ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php if ($total_page > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <a href="?page=<?= $i; ?>&keyword=<?= urlencode($keyword); ?>&kategori=<?= urlencode($kategori); ?>"
               class="<?= $page == $i ? 'active' : ''; ?>">
                <?= $i; ?>
            </a>
        <?php endfor; ?>
    </div>
    <?php endif; ?>
</div>

</body>
</html>
