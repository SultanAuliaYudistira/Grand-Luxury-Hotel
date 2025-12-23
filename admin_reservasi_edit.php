<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

include "config/koneksi.php";

$id = $_GET['id'] ?? 0;
if (!$id) {
    header("Location: admin_reservasi.php");
    exit;
}

/* ================= DATA RESERVASI ================= */
$res = mysqli_query($koneksi, "
    SELECT r.*, u.nama, k.nama_kamar
    FROM tbl_reservasi r
    JOIN tbl_user u ON r.id_user = u.id_user
    JOIN tbl_kamar k ON r.id_kamar = k.id_kamar
    WHERE r.id_reservasi='$id'
");
$row = mysqli_fetch_assoc($res);
if (!$row) {
    header("Location: admin_reservasi.php");
    exit;
}

/* ================= DATA PEMBAYARAN ================= */
$pembayaran = mysqli_query($koneksi, "
    SELECT * FROM tbl_pembayaran
    WHERE id_reservasi='$id'
");
$bayar = mysqli_fetch_assoc($pembayaran);

/* ================= UPDATE STATUS + STOK ================= */
if (isset($_POST['update']) && $bayar) {

    $statusBaru = $_POST['status'];

    // ambil status lama + data kamar
    $cek = mysqli_query($koneksi, "
        SELECT status, id_kamar, jumlah_kamar
        FROM tbl_reservasi
        WHERE id_reservasi='$id'
    ");
    $lama = mysqli_fetch_assoc($cek);

    // stok berkurang HANYA SEKALI
    if ($statusBaru == 'Sudah Dibayar' && $lama['status'] != 'Sudah Dibayar') {
        mysqli_query($koneksi, "
            UPDATE tbl_kamar
            SET stok = stok - {$lama['jumlah_kamar']}
            WHERE id_kamar = {$lama['id_kamar']}
        ");
    }

    // update status reservasi
    mysqli_query($koneksi, "
        UPDATE tbl_reservasi
        SET status='$statusBaru'
        WHERE id_reservasi='$id'
    ");

    header("Location: admin_reservasi.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Status Reservasi</title>
    <link rel="stylesheet" href="public/css/admin.css">
</head>
<body>

<h2>Ubah Status Reservasi</h2>

<p><b>User:</b> <?= $row['nama'] ?></p>
<p><b>Kamar:</b> <?= $row['nama_kamar'] ?></p>
<p><b>Total:</b> Rp <?= number_format($row['total_harga'],0,',','.') ?></p>
<p><b>Status Saat Ini:</b> <?= $row['status'] ?></p>

<hr>

<h3>Data Pembayaran</h3>

<?php if ($bayar): ?>
    <p><b>Metode:</b> <?= $bayar['metode'] ?></p>
    <p><b>Tanggal Bayar:</b> <?= $bayar['tanggal_bayar'] ?></p>

    <p><b>Bukti Pembayaran:</b></p>
    <img src="assets/bukti/<?= $bayar['bukti'] ?>"
         style="max-width:320px;border:1px solid #ccc;padding:6px;">
<?php else: ?>
    <p style="color:red;">
        <i>User belum mengirim bukti pembayaran.</i>
    </p>
<?php endif; ?>

<hr>

<form method="post">
    Status<br>
    <select name="status" <?= !$bayar ? 'disabled' : '' ?>>
        <option <?= $row['status']=='Menunggu Pembayaran'?'selected':'' ?>>
            Menunggu Pembayaran
        </option>
        <option <?= $row['status']=='Sudah Dibayar'?'selected':'' ?>>
            Sudah Dibayar
        </option>
        <option <?= $row['status']=='Selesai'?'selected':'' ?>>
            Selesai
        </option>
    </select><br><br>

    <?php if ($bayar): ?>
        <button name="update">Update Status</button>
    <?php else: ?>
        <p style="color:red;">
            Status tidak dapat diubah sebelum ada bukti pembayaran.
        </p>
    <?php endif; ?>
</form>

<br>
<a href="admin_reservasi.php">⬅ Kembali</a>

</body>
</html>
