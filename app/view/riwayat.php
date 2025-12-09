<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Harap login terlebih dahulu!'); window.location='?page=login';</script>";
    exit;
}

include "config/koneksi.php";
$id_user = $_SESSION["user_id"];
$q = mysqli_query($koneksi, "SELECT * FROM tbl_reservasi WHERE id_user='$id_user'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pemesanan - Grand Luxury Hotel</title>
</head>
<body style="font-family: Arial; background:#0e0e0e; color:white; margin:0; padding:40px;">

<h1 style="text-align:center; color:gold; margin-bottom:35px;">Riwayat Pemesanan</h1>

<table border="1" cellpadding="12" cellspacing="0" style="width:80%; margin:auto; text-align:center; background:#1b1b1b; border-color:gold;">
<tr style="background:black; color:gold;">
    <th>No</th>
    <th>Tipe Kamar</th>
    <th>Check-In</th>
    <th>Check-Out</th>
    <th>Jumlah Tamu</th>
    <th>Status</th>
</tr>

<?php
$no = 1;
while($row = mysqli_fetch_assoc($q)){
    echo "
    <tr>
        <td>$no</td>
        <td>{$row['tipe_kamar']}</td>
        <td>{$row['tanggal_checkin']}</td>
        <td>{$row['tanggal_checkout']}</td>
        <td>{$row['jumlah_tamu']}</td>
        <td>{$row['status']}</td>
    </tr>
    ";
    $no++;
}
?>
</table>

<div style="text-align:center; margin-top:35px;">
    <a href='?page=dashboard' style='background:gold; color:black; padding:12px 22px; border-radius:6px; text-decoration:none; font-weight:bold;'>Kembali ke Dashboard</a>
</div>

</body>
</html>
