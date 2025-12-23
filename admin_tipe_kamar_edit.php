<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}
include "config/koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM tbl_tipe_kamar WHERE id_tipe='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    mysqli_query($koneksi, "
        UPDATE tbl_tipe_kamar
        SET nama_tipe='$_POST[nama]', harga='$_POST[harga]', deskripsi='$_POST[deskripsi]'
        WHERE id_tipe='$id'
    ");
    header("Location: admin_tipe_kamar.php");
}
?>

<h2>Edit Tipe Kamar</h2>
<link rel="stylesheet" href="public/css/admin.css">

<form method="post">
    Nama Tipe<br>
    <input type="text" name="nama" value="<?= $row['nama_tipe'] ?>"><br><br>

    Harga per Malam<br>
    <input type="number" name="harga" value="<?= $row['harga'] ?>"><br><br>

    Deskripsi<br>
    <textarea name="deskripsi" rows="4"><?= $row['deskripsi'] ?></textarea><br><br>

    <button name="update">Update</button>
</form>
