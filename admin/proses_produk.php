<?php
require_once "../includes/auth.php";
require_once "../config/database.php";

session_start();

$aksi = $_POST['aksi'] ?? '';

function upload_gambar($field, $target_dir, $redirect_url) {
    if (!isset($_FILES[$field]) || $_FILES[$field]['error'] != 0) {
        return null;
    }

    $file = $_FILES[$field];
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($extension, $allowed)) {
        $_SESSION['error'] = "Format gambar tidak diperbolehkan.";
        header("Location: $redirect_url");
        exit;
    }

    if ($file['size'] > 2 * 1024 * 1024) {
        $_SESSION['error'] = "Ukuran gambar maksimal 2 MB.";
        header("Location: $redirect_url");
        exit;
    }

    $nama_file = uniqid() . "." . $extension;
    move_uploaded_file($file['tmp_name'], $target_dir . $nama_file);

    return $nama_file;
}

if ($aksi == 'tambah') {
    $nama = trim($_POST['nama'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $harga = $_POST['harga'] ?? '';
    $stok = $_POST['stok'] ?? '';

    if ($nama == '' || $kategori == '' || $deskripsi == '' || $harga == '' || $stok == '') {
        $_SESSION['error'] = "Semua data wajib diisi.";
        header("Location: tambah.php");
        exit;
    }

    if (!is_numeric($harga) || !is_numeric($stok)) {
        $_SESSION['error'] = "Harga dan stok harus berupa angka.";
        header("Location: tambah.php");
        exit;
    }

    $nama_file = upload_gambar('gambar', '../uploads/produk/', 'tambah.php');

    $nama = mysqli_real_escape_string($conn, $nama);
    $kategori = mysqli_real_escape_string($conn, $kategori);
    $deskripsi = mysqli_real_escape_string($conn, $deskripsi);

    $query = mysqli_query(
        $conn,
        "INSERT INTO produk
        (nama, kategori, deskripsi, harga, stok, gambar)
        VALUES
        ('$nama', '$kategori', '$deskripsi', '$harga', '$stok', '$nama_file')"
    );

    $_SESSION[$query ? 'success' : 'error'] =
        $query ? "Produk berhasil ditambahkan." : "Produk gagal ditambahkan.";

    header("Location: produk.php");
    exit;
}

if ($aksi == 'edit') {
    $id = (int)($_POST['id'] ?? 0);
    $nama = trim($_POST['nama'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $harga = $_POST['harga'] ?? '';
    $stok = $_POST['stok'] ?? '';

    if ($nama == '' || $kategori == '' || $deskripsi == '' || $harga == '' || $stok == '') {
        $_SESSION['error'] = "Semua data wajib diisi.";
        header("Location: edit.php?id=$id");
        exit;
    }

    if (!is_numeric($harga) || !is_numeric($stok)) {
        $_SESSION['error'] = "Harga dan stok harus berupa angka.";
        header("Location: edit.php?id=$id");
        exit;
    }

    $old_query = mysqli_query($conn, "SELECT gambar FROM produk WHERE id = $id");
    $old_data = mysqli_fetch_assoc($old_query);
    $nama_file = $old_data['gambar'];

    $new_file = upload_gambar('gambar', '../uploads/produk/', "edit.php?id=$id");

    if ($new_file) {
        if ($old_data['gambar'] && file_exists("../uploads/produk/" . $old_data['gambar'])) {
            unlink("../uploads/produk/" . $old_data['gambar']);
        }
        $nama_file = $new_file;
    }

    $nama = mysqli_real_escape_string($conn, $nama);
    $kategori = mysqli_real_escape_string($conn, $kategori);
    $deskripsi = mysqli_real_escape_string($conn, $deskripsi);

    $query = mysqli_query(
        $conn,
        "UPDATE produk SET
        nama = '$nama',
        kategori = '$kategori',
        deskripsi = '$deskripsi',
        harga = '$harga',
        stok = '$stok',
        gambar = '$nama_file'
        WHERE id = $id"
    );

    $_SESSION[$query ? 'success' : 'error'] =
        $query ? "Produk berhasil diperbarui." : "Produk gagal diperbarui.";

    header("Location: produk.php");
    exit;
}
?>
