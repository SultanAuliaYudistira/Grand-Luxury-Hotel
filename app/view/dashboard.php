<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    // jika user belum login
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='?page=login';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Grand Luxury Hotel</title>
</head>
<body style="font-family: Arial; background: #0e0e0e; color:white; margin:0;">

<div style="padding: 40px; text-align:center;">
    <h1 style="color: gold;">Selamat Datang, <?php echo $_SESSION["nama"]; ?> 👋</h1>
    <p style="margin-top: 10px;">Anda berhasil login ke sistem reservasi Grand Luxury Hotel.</p>

    <div style="margin-top: 50px; display:flex; justify-content:center; gap:25px;">
        <a href="?page=pesan" style="background:gold; color:black; padding:12px 25px; border-radius:6px; text-decoration:none; font-weight:bold;">Pesan Kamar</a>
        <a href="?page=riwayat" style="background:gold; color:black; padding:12px 25px; border-radius:6px; text-decoration:none; font-weight:bold;">Riwayat Pesanan</a>
        <a href="?page=logout" style="background:red; color:white; padding:12px 25px; border-radius:6px; text-decoration:none; font-weight:bold;">Logout</a>
    </div>
</div>

</body>
</html>
