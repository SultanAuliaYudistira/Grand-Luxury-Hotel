<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include __DIR__ . "/../../config/koneksi.php";

if (!isset($_SESSION['user_id'])) {
    die("Harap login terlebih dahulu");
}

$id_user = $_SESSION['user_id'];
$id_reservasi = (int)($_GET['id_reservasi'] ?? 0);

if ($id_reservasi <= 0) {
    die("Struk tidak valid");
}

/* AMBIL DATA STRUK */
$q = mysqli_query($koneksi, "
    SELECT 
        r.id_reservasi,
        r.tanggal_checkin,
        r.tanggal_checkout,
        r.jumlah_kamar,
        r.total_harga,
        r.status AS status_reservasi,

        t.nama_tipe,
        k.nomor_kamar,

        p.metode,
        p.jumlah,
        p.bukti,
        p.status AS status_pembayaran,
        p.tanggal_bayar

    FROM tbl_reservasi r
    JOIN tbl_kamar k ON r.id_kamar = k.id_kamar
    JOIN tbl_tipe_kamar t ON k.id_tipe = t.id_tipe
    JOIN tbl_pembayaran p ON r.id_reservasi = p.id_reservasi

    WHERE r.id_reservasi = $id_reservasi
      AND r.id_user = $id_user
    LIMIT 1
");

if (!$q || mysqli_num_rows($q) === 0) {
    die("Data struk tidak ditemukan");
}

$data = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Struk Pembayaran</title>

<style>
body{
    margin:0;
    padding:40px;
    font-family:Arial, sans-serif;
    background:#0e0e0e;
    color:white;
}
.struk{
    width:420px;
    margin:auto;
    background:#1b1b1b;
    border-radius:16px;
    padding:25px;
    box-shadow:0 0 20px rgba(255,215,0,.15);
}
h1{
    text-align:center;
    color:gold;
    margin-bottom:20px;
}
.row{
    display:flex;
    justify-content:space-between;
    margin:8px 0;
    font-size:14px;
}
.row span:last-child{
    font-weight:bold;
}
hr{
    border:1px dashed gold;
    margin:15px 0;
}
.total{
    text-align:center;
    font-size:22px;
    color:gold;
    margin-top:10px;
}
.status{
    text-align:center;
    margin-top:10px;
    padding:8px;
    border-radius:8px;
    font-weight:bold;
}
.status.proses{ background:#333; color:orange; }
.status.disetujui{ background:#1e4023; color:lime; }
.status.ditolak{ background:#401e1e; color:red; }

.btn{
    display:block;
    text-align:center;
    margin-top:20px;
    padding:12px;
    background:gold;
    color:black;
    text-decoration:none;
    border-radius:10px;
    font-weight:bold;
}
img.bukti{
    width:100%;
    border-radius:10px;
    margin-top:10px;
}
</style>
</head>

<body>

<div class="struk">

<h1>STRUK PEMBAYARAN</h1>

<div class="row"><span>Hotel</span><span>Grand Luxury Hotel</span></div>
<div class="row"><span>ID Reservasi</span><span>#<?= $data['id_reservasi'] ?></span></div>

<hr>

<div class="row"><span>Tipe Kamar</span><span><?= $data['nama_tipe'] ?></span></div>
<div class="row"><span>Nomor Kamar</span><span><?= $data['nomor_kamar'] ?></span></div>
<div class="row"><span>Check-in</span><span><?= $data['tanggal_checkin'] ?></span></div>
<div class="row"><span>Check-out</span><span><?= $data['tanggal_checkout'] ?></span></div>
<div class="row"><span>Jumlah Kamar</span><span><?= $data['jumlah_kamar'] ?></span></div>

<hr>

<div class="row"><span>Metode</span><span><?= $data['metode'] ?></span></div>
<div class="row"><span>Tanggal Bayar</span><span><?= $data['tanggal_bayar'] ?></span></div>

<div class="total">
Rp <?= number_format($data['total_harga'],0,',','.') ?>
</div>

<div class="status <?= strtolower($data['status_pembayaran']) ?>">
<?= strtoupper($data['status_pembayaran']) ?>
</div>

<?php if (!empty($data['bukti'])): ?>
    <p style="margin-top:15px;">Bukti Pembayaran:</p>
    <img class="bukti" src="assets/bukti/<?= $data['bukti'] ?>">
<?php endif; ?>

<a href="?page=riwayat" class="btn">Lihat Riwayat</a>

</div>

</body>
</html>
