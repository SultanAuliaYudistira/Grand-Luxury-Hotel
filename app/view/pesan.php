<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Harap login terlebih dahulu!'); window.location='?page=login';</script>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pilih Kamar - Grand Luxury Hotel</title>
</head>

<body style="font-family: Arial; background:#0e0e0e; color:white; margin:0; padding:40px;">

<h1 style="text-align:center; color:gold; margin-bottom:30px;">Pilih Kamar</h1>

<div style="display:flex; justify-content:center; gap:35px; flex-wrap:wrap;">

    <!-- Standard Room -->
    <div style="background:#1b1b1b; width:300px; border-radius:12px; padding:18px; text-align:center;">
        <img src="assets/img/standard.jpg" style="width:100%; border-radius:12px;">
        <h2 style="color:gold;">Standard Room</h2>
        <p>Rp 500.000 / malam</p>

        <div style="display:flex; gap:10px; margin-top:15px; justify-content:center;">
            <a href="?page=detail_kamar&kamar=<?= urlencode('Standard Room') ?>"
               style="background:#444; color:white; padding:8px 12px; border-radius:6px; text-decoration:none;">
               Detail
            </a>

            <a href="?page=form_pesan&kamar=Standard Room"
               style="background:gold; color:black; padding:8px 12px; border-radius:6px; font-weight:bold; text-decoration:none;">
               Pesan
            </a>
        </div>
    </div>

    <!-- Deluxe Room -->
    <div style="background:#1b1b1b; width:300px; border-radius:12px; padding:18px; text-align:center;">
        <img src="assets/img/deluxe.jpg" style="width:100%; border-radius:12px;">
        <h2 style="color:gold;">Deluxe Room</h2>
        <p>Rp 750.000 / malam</p>

        <div style="display:flex; gap:10px; margin-top:15px; justify-content:center;">
            <a href="?page=detail_kamar&kamar=<?= urlencode('Deluxe Room') ?>"
               style="background:#444; color:white; padding:8px 12px; border-radius:6px; text-decoration:none;">
               Detail
            </a>

            <a href="?page=form_pesan&kamar=Deluxe Room"
               style="background:gold; color:black; padding:8px 12px; border-radius:6px; font-weight:bold; text-decoration:none;">
               Pesan
            </a>
        </div>
    </div>

    <!-- Suite Room -->
    <div style="background:#1b1b1b; width:300px; border-radius:12px; padding:18px; text-align:center;">
        <img src="assets/img/suite.jpg" style="width:100%; border-radius:12px;">
        <h2 style="color:gold;">Suite Room</h2>
        <p>Rp 1.000.000 / malam</p>

        <div style="display:flex; gap:10px; margin-top:15px; justify-content:center;">
            <a href="?page=detail_kamar&kamar=<?= urlencode('Suite Room') ?>"
               style="background:#444; color:white; padding:8px 12px; border-radius:6px; text-decoration:none;">
               Detail
            </a>

            <a href="?page=form_pesan&kamar=Suite Room"
               style="background:gold; color:black; padding:8px 12px; border-radius:6px; font-weight:bold; text-decoration:none;">
               Pesan
            </a>
        </div>
    </div>

</div>

</body>
</html>
