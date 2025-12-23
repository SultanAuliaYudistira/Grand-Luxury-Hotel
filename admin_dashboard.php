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
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="public/css/admin.css">
</head>
<body>

<h2>Dashboard Admin</h2>
<hr>

<p>Selamat datang, Admin.</p>

<ul>
    <li><a href="admin_tipe_kamar.php">Manajemen Tipe Kamar</a></li>
    <li><a href="admin_kamar.php">Manajemen Kamar</a></li>
    <li><a href="admin_reservasi.php">Manajemen Reservasi</a></li>
    <li><a href="admin_logout.php">Logout</a></li>
</ul>

</body>
</html>
