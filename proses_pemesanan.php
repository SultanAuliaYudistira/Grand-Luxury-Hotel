<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include __DIR__ . "/../../config/koneksi.php";

$id_user   = $_SESSION['user_id'];
$id_kamar  = $_POST['id_kamar'];
$checkin   = $_POST['checkin'];
$checkout  = $_POST['checkout'];
$jumlah    = $_POST['jumlah'];
$total     = $_POST['total'];


if (!$id_user || !$id_kamar || !$checkin || !$checkout) {
    die("Data tidak lengkap");
}

$insert = mysqli_query($koneksi, "
    INSERT INTO tbl_reservasi
    (id_user, id_kamar, tanggal_checkin, tanggal_checkout, jumlah_kamar, total_harga, status)
    VALUES
    ('$id_user','$id_kamar','$checkin','$checkout','$jumlah','$total','Menunggu Pembayaran')
");

if (!$insert) {
    die("ERROR MYSQL: " . mysqli_error($koneksi));
}

$id_reservasi = mysqli_insert_id($koneksi);

// redirect ke pembayaran
header("Location: ?page=Pembayaran&id_reservasi=$id_reservasi");
exit;
