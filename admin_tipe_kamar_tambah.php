<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

include "config/koneksi.php";

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($koneksi, "
        INSERT INTO tbl_tipe_kamar (nama_tipe, harga, deskripsi)
        VALUES ('$nama', '$harga', '$deskripsi')
    ");

    header("Location: admin_tipe_kamar.php");
    exit;
}
?>

<h2>Tambah Tipe Kamar</h2>
<link rel="stylesheet" href="public/css/admin.css">


<form method="post">
    Nama Tipe<br>
    <input type="text" name="nama" required><br><br>

    Harga per Malam<br>
    <input type="number" name="harga" required><br><br>

    Deskripsi<br>
    <textarea name="deskripsi" rows="4" required></textarea><br><br>

    <button name="simpan">Simpan</button>
</form>
