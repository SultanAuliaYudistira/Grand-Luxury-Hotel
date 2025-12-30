<?php
// ================= SESSION =================
if (session_status() === PHP_SESSION_NONE) session_start();
include __DIR__ . "/../../config/koneksi.php";

// ================= CEK LOGIN =================
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Harap login terlebih dahulu!'); location='?page=login';</script>";
    exit;
}

$id_user      = (int) $_SESSION['user_id'];
$id_reservasi = (int) ($_GET['id_reservasi'] ?? 0);

if ($id_reservasi <= 0) {
    die("Reservasi tidak valid");
}

// ================= AMBIL DATA RESERVASI =================
$q = mysqli_query($koneksi, "
    SELECT total_harga, status
    FROM tbl_reservasi
    WHERE id_reservasi = $id_reservasi
    AND id_user = $id_user
    LIMIT 1
");

$reservasi = mysqli_fetch_assoc($q);

if (!$reservasi) {
    die("Reservasi tidak ditemukan");
}

if ($reservasi['status'] !== 'Menunggu Pembayaran') {
    die("Reservasi sudah diproses");
}

$total = (int) $reservasi['total_harga'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pembayaran</title>

<style>
body{
    margin:0;
    padding:40px;
    font-family:Arial;
    background:#0e0e0e;
    color:white;
}
.box{
    width:430px;
    margin:auto;
    background:#1b1b1b;
    padding:25px;
    border-radius:14px;
}
h1{text-align:center;color:gold;}
select,input,button{
    width:100%;
    padding:10px;
    margin-top:10px;
    border-radius:6px;
    border:none;
}
button{
    background:gold;
    font-weight:bold;
    cursor:pointer;
}
.method{display:none;margin-top:20px;}
.logo{text-align:center;}
.logo img{width:120px;}
</style>
</head>

<body>

<h1>Pembayaran</h1>

<div class="box">

<p>Total Pembayaran:</p>
<h2 style="color:gold;">Rp <?= number_format($total,0,',','.'); ?></h2>

<label>Metode Pembayaran</label>
<select id="metode" onchange="pilihMetode()">
    <option value="">-- Pilih Metode --</option>
    <option value="bank">Bank Transfer</option>
    <option value="ewallet">E-Wallet</option>
    <option value="cc">Credit Card</option>
</select>

<!-- BANK -->
<div id="bank" class="method">
    <div class="logo"><img src="public/img/bank.jpeg"></div>
    <p>BCA: <b>1234567890</b></p>
    <p>BRI: <b>9876543210</b></p>

    <form method="POST" action="?page=simpan_pembayaran" enctype="multipart/form-data">
        <input type="hidden" name="id_reservasi" value="<?= $id_reservasi ?>">
        <input type="hidden" name="total" value="<?= $total ?>">
        <input type="hidden" name="metode" value="Bank Transfer">

        <label>Upload Bukti</label>
        <input type="file" name="bukti" required>

        <button>Kirim Bukti</button>
    </form>
</div>

<!-- EWALLET -->
<div id="ewallet" class="method">
    <div class="logo"><img src="public/img/ewallet.jpeg"></div>
    <p>DANA / OVO / GoPay</p>
    <p>No: <b>081234567890</b></p>

    <form method="POST" action="?page=simpan_pembayaran" enctype="multipart/form-data">
        <input type="hidden" name="id_reservasi" value="<?= $id_reservasi ?>">
        <input type="hidden" name="total" value="<?= $total ?>">
        <input type="hidden" name="metode" value="E-Wallet">

        <label>Upload Bukti</label>
        <input type="file" name="bukti" required>

        <button>Kirim Bukti</button>
    </form>
</div>

<!-- CREDIT CARD -->
<div id="cc" class="method">
    <div class="logo"><img src="public/img/cc.jpeg"></div>

    <form method="POST" action="?page=simpan_pembayaran">
        <input type="hidden" name="id_reservasi" value="<?= $id_reservasi ?>">
        <input type="hidden" name="total" value="<?= $total ?>">
        <input type="hidden" name="metode" value="Credit Card">

        <input type="text" name="card_number" placeholder="Nomor Kartu" required>
        <input type="text" name="card_name" placeholder="Nama di Kartu" required>
        <input type="password" name="cvv" placeholder="CVV" required>

        <button>Bayar Sekarang</button>
    </form>
</div>

</div>

<script>
function pilihMetode(){
    document.querySelectorAll('.method')
        .forEach(el => el.style.display='none');
    let m = document.getElementById('metode').value;
    if(m) document.getElementById(m).style.display='block';
}
</script>

</body>
</html>
