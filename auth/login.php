<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    header("Location: ../admin/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - DOA Coffee</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="login-page">

<div class="container">
    <div class="card login-card">
        <div class="brand login-brand">DOA <span>COFFEE</span></div>
        <h1>Login Admin</h1>
        <p>Kelola katalog produk Doa Coffee melalui dashboard.</p>

        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert error">' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <form action="proses_login.php" method="POST">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" class="btn full">Login</button>
        </form>

        <a href="../index.php" class="back-link">← Kembali ke Website</a>
    </div>
</div>

</body>
</html>
