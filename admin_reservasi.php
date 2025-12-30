<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

include "config/koneksi.php";

$data = mysqli_query($koneksi, "
    SELECT r.*, u.nama, k.nama_kamar
    FROM tbl_reservasi r
    JOIN tbl_user u ON r.id_user = u.id_user
    JOIN tbl_kamar k ON r.id_kamar = k.id_kamar
    ORDER BY r.id_reservasi DESC
");
?>

<h2>Manajemen Reservasi</h2>
<link rel="stylesheet" href="public/css/admin.css">

<hr>

<table border="1" cellpadding="8">
<tr>
    <th>No</th>
    <th>Nama User</th>
    <th>Kamar</th>
    <th>Check-in</th>
    <th>Check-out</th>
    <th>Total</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['nama_kamar'] ?></td>
    <td><?= $row['tanggal_checkin'] ?></td>
    <td><?= $row['tanggal_checkout'] ?></td>
    <td>Rp <?= number_format($row['total_harga'],0,',','.') ?></td>
    <td><?= $row['status'] ?></td>
    <td>
        <a href="admin_reservasi_edit.php?id=<?= $row['id_reservasi'] ?>">
            Ubah Status
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<br>
<a href="admin_dashboard.php">⬅ Kembali</a>
