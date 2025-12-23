<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Harap login terlebih dahulu!'); window.location='?page=login';</script>";
    exit;
}

include "config/koneksi.php";
$id_user = $_SESSION["user_id"];

/* JOIN RESERVASI + KAMAR + TIPE + PEMBAYARAN */
$q = mysqli_query($koneksi, "
    SELECT 
        r.id_reservasi,
        r.tanggal_checkin,
        r.tanggal_checkout,
        r.jumlah_kamar,
        r.total_harga,
        r.status,
        t.nama_tipe,
        p.metode,
        p.tanggal_bayar
    FROM tbl_reservasi r
    JOIN tbl_kamar k ON r.id_kamar = k.id_kamar
    JOIN tbl_tipe_kamar t ON k.id_tipe = t.id_tipe
    LEFT JOIN tbl_pembayaran p ON r.id_reservasi = p.id_reservasi
    WHERE r.id_user = '$id_user'
    ORDER BY r.id_reservasi DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Riwayat Pemesanan</title>
</head>

<body style="font-family:Arial; background:#0e0e0e; color:white; padding:40px;">

<h1 style="text-align:center; color:gold; margin-bottom:35px;">
    Riwayat Pemesanan
</h1>

<table cellpadding="12" cellspacing="0"
       style="width:95%; margin:auto; border-collapse:collapse; background:#1b1b1b;">

<tr style="background:black; color:gold;">
    <th>No</th>
    <th>Tipe Kamar</th>
    <th>Check-In</th>
    <th>Check-Out</th>
    <th>Jumlah Kamar</th>
    <th>Total</th>
    <th>Status</th>
    <th>Struk</th>
</tr>

<?php
$no = 1;
while ($row = mysqli_fetch_assoc($q)) {

    /* STATUS */
    if ($row['status'] == "Disetujui") {
        $label = "<span style='color:lime;font-weight:bold;'>Disetujui</span>";
        $struk = "
            <a href='?page=struk&id_reservasi={$row['id_reservasi']}'
               style='color:gold;font-weight:bold;'>Lihat</a>
        ";
    } elseif ($row['status'] == "Menunggu Konfirmasi") {
        $label = "<span style='color:orange;'>Menunggu Konfirmasi</span>";
        $struk = "-";
    } else {
        $label = "<span style='color:red;'>Menunggu Pembayaran</span>";
        $struk = "-";
    }

    echo "
    <tr style='text-align:center;'>
        <td>$no</td>
        <td>{$row['nama_tipe']}</td>
        <td>{$row['tanggal_checkin']}</td>
        <td>{$row['tanggal_checkout']}</td>
        <td>{$row['jumlah_kamar']}</td>
        <td>Rp ".number_format($row['total_harga'],0,',','.')."</td>
        <td>$label</td>
        <td>$struk</td>
    </tr>";
    $no++;
}
?>

</table>

<div style="text-align:center; margin-top:35px;">
    <a href="?page=dashboard"
       style="background:gold; color:black; padding:12px 25px;
              border-radius:6px; text-decoration:none; font-weight:bold;">
        Kembali ke Dashboard
    </a>
</div>

</body>
</html>
