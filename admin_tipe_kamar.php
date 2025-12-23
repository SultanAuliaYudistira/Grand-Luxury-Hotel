<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

include "config/koneksi.php";
$data = mysqli_query($koneksi, "SELECT * FROM tbl_tipe_kamar");
?>

<h2>Manajemen Tipe Kamar</h2>
<link rel="stylesheet" href="public/css/admin.css">
<a href="admin_tipe_kamar_tambah.php">+ Tambah Tipe Kamar</a>
<hr>

<table border="1" cellpadding="8">
<tr>
    <th>No</th>
    <th>Nama Tipe</th>
    <th>Harga</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['nama_tipe'] ?></td>
    <td>Rp <?= number_format($row['harga'],0,',','.') ?></td>
    <td>
        <a href="admin_tipe_kamar_edit.php?id=<?= $row['id_tipe'] ?>">Edit</a> |
        <a href="admin_tipe_kamar_hapus.php?id=<?= $row['id_tipe'] ?>"
           onclick="return confirm('Hapus tipe kamar ini?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<br>
<a href="admin_dashboard.php">⬅ Kembali</a>
