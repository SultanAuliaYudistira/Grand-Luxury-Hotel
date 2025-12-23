<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

include "config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM tbl_kamar WHERE id_kamar='$id'");
$row = mysqli_fetch_assoc($data);

$tipe = mysqli_query($koneksi, "SELECT * FROM tbl_tipe_kamar");

if (isset($_POST['update'])) {

    mysqli_query($koneksi, "
        UPDATE tbl_kamar SET
        nama_kamar='$_POST[nama]',
        nomor_kamar='$_POST[nomor]',
        id_tipe='$_POST[id_tipe]',
        stok='$_POST[stok]'
        WHERE id_kamar='$id'
    ");

    header("Location: admin_kamar.php");
    exit;
}
?>

<h2>Edit Kamar</h2>
<link rel="stylesheet" href="public/css/admin.css">

<form method="post">
    Nama Kamar<br>
    <input type="text" name="nama" value="<?= $row['nama_kamar'] ?>"><br><br>

    Nomor Kamar<br>
    <input type="text" name="nomor" value="<?= $row['nomor_kamar'] ?>"><br><br>

    Tipe Kamar<br>
    <select name="id_tipe">
        <?php while($t=mysqli_fetch_assoc($tipe)): ?>
            <option value="<?= $t['id_tipe'] ?>"
                <?= $t['id_tipe']==$row['id_tipe']?'selected':'' ?>>
                <?= $t['nama_tipe'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    Stok<br>
    <input type="number" name="stok" value="<?= $row['stok'] ?>"><br><br>

    <button name="update">Update</button>
</form>
