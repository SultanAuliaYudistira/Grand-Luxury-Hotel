<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

include "config/koneksi.php";
$tipe = mysqli_query($koneksi, "SELECT * FROM tbl_tipe_kamar");

if (isset($_POST['simpan'])) {

    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];

    // rename biar unik
    $namaFoto = time() . "_" . $foto;
    move_uploaded_file($tmp, "public/img/" . $namaFoto);

    mysqli_query($koneksi, "
        INSERT INTO tbl_kamar
        (nama_kamar, nomor_kamar, id_tipe, stok, foto)
        VALUES
        ('$_POST[nama]', '$_POST[nomor]', '$_POST[id_tipe]', '$_POST[stok]', '$namaFoto')
    ");

    header("Location: admin_kamar.php");
    exit;
}
?>

<h2>Tambah Kamar</h2>
<link rel="stylesheet" href="public/css/admin.css">

<form method="post" enctype="multipart/form-data">
    Nama Kamar<br>
    <input type="text" name="nama" required><br><br>

    Nomor Kamar<br>
    <input type="text" name="nomor" required><br><br>

    Tipe Kamar<br>
    <select name="id_tipe" required>
        <?php while($t=mysqli_fetch_assoc($tipe)): ?>
            <option value="<?= $t['id_tipe'] ?>"><?= $t['nama_tipe'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    Stok<br>
    <input type="number" name="stok" required><br><br>

    Foto Kamar<br>
    <input type="file" name="foto" accept="image/*" required><br><br>

    <button name="simpan">Simpan</button>
</form>
