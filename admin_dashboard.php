<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | Grand Luxury Hotel</title>
    <link rel="stylesheet" href="public/css/admin-dashboard.css">
</head>
<body>

<div class="dashboard-container">

    <header class="dashboard-header">
        <h1>Dashboard Admin</h1>
        <p>Grand Luxury Hotel Management</p>
    </header>

    <section class="dashboard-menu">

        <a href="admin_tipe_kamar.php" class="menu-card">
            <h3>🏷️ Tipe Kamar</h3>
            <p>Kelola tipe dan harga kamar</p>
        </a>

        <a href="admin_kamar.php" class="menu-card">
            <h3>🛏️ Data Kamar</h3>
            <p>Tambah & atur stok kamar</p>
        </a>

        <a href="admin_reservasi.php" class="menu-card">
            <h3>📑 Reservasi</h3>
            <p>Konfirmasi & kelola pemesanan</p>
        </a>

        <a href="admin_logout.php" class="menu-card logout">
            <h3>🚪 Logout</h3>
            <p>Keluar dari sistem admin</p>
        </a>

    </section>

</div>

</body>
</html>
