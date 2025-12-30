<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

include "config/koneksi.php";

$data = mysqli_query($koneksi, "
    SELECT k.*, t.nama_tipe
    FROM tbl_kamar k
    JOIN tbl_tipe_kamar t ON k.id_tipe = t.id_tipe
");
?>

<h2>Manajemen Kamar</h2>
<link rel="stylesheet" href="public/css/admin.css">
<a href="admin_kamar_tambah.php">+ Tambah Kamar</a>
<hr>

<table border="1" cellpadding="8">
<tr>
    <th>No</th>
    <th>Nama Kamar</th>
    <th>Nomor</th>
    <th>Tipe</th>
    <th>Stok</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['nama_kamar'] ?></td>
    <td><?= $row['nomor_kamar'] ?></td>
    <td><?= $row['nama_tipe'] ?></td>
    <td><?= $row['stok'] ?></td>
    <td>
        <a href="admin_kamar_edit.php?id=<?= $row['id_kamar'] ?>">Edit</a> |
        <a href="admin_kamar_hapus.php?id=<?= $row['id_kamar'] ?>"
           onclick="return confirm('Hapus kamar ini?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<br>
<a href="admin_dashboard.php">⬅ Kembali</a>
