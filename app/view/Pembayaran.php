<?php
<<<<<<< HEAD
if (session_status() === PHP_SESSION_NONE) session_start();
=======
// ================= SESSION =================
if (session_status() === PHP_SESSION_NONE) session_start();
include __DIR__ . "/../../config/koneksi.php";

// ================= CEK LOGIN =================
>>>>>>> aec976d (Menambahkan file admin)
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Harap login terlebih dahulu!'); location='?page=login';</script>";
    exit;
}

<<<<<<< HEAD
$total = isset($_POST['total']) ? (int) $_POST['total'] : 0;
?>

=======
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
>>>>>>> aec976d (Menambahkan file admin)
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pembayaran</title>
<<<<<<< HEAD
</head>

<body style="
    margin:0;
    padding:40px;
    font-family:Arial, sans-serif;
    background:#0e0e0e;
    color:white;
">

<h1 style="text-align:center; color:gold; margin-bottom:30px;">
    Pembayaran
</h1>

<div style="
=======

<style>
body{
    margin:0;
    padding:40px;
    font-family:Arial;
    background:#0e0e0e;
    color:white;
}
.box{
>>>>>>> aec976d (Menambahkan file admin)
    width:430px;
    margin:auto;
    background:#1b1b1b;
    padding:25px;
<<<<<<< HEAD
    border-radius:12px;
    box-shadow:0 0 12px rgba(255,255,255,0.1);
">

    <p style="margin-bottom:5px;">Total yang harus dibayar:</p>
    <h2 style="color:gold; margin-top:0;">
        Rp <?= number_format($total) ?>
    </h2>

    <label style="color:gold;">Metode Pembayaran</label>
    <select id="metode" onchange="pilihMetode()"
            style="width:100%; padding:10px; margin-top:8px; border-radius:6px;">
        <option value="">-- Pilih Metode --</option>
        <option value="bank">Bank Transfer</option>
        <option value="ewallet">E-Wallet</option>
        <option value="cc">Credit Card</option>
    </select>

    <!-- ================= BANK ================= -->
    <div id="bank" style="display:none; margin-top:20px;">
        <h4 style="color:gold;">Transfer ke Rekening Hotel</h4>
        <ul>
            <li>BCA : <b>1234567890</b></li>
            <li>BRI : <b>9876543210</b></li>
        </ul>

        <form method="POST" action="?page=simpan_pembayaran" enctype="multipart/form-data">
            <input type="hidden" name="metode" value="Bank Transfer">
            <input type="hidden" name="total" value="<?= $total ?>">
            <input type="hidden" name="id_reservasi" value="<?= $id_reservasi ?>">


            <label style="color:gold;">Upload Bukti Transfer</label>
            <input type="file" name="bukti" required
                   style="width:100%; padding:8px; margin-top:8px; border-radius:6px;">

            <button style="
                margin-top:15px;
                width:100%;
                background:gold;
                color:black;
                padding:10px;
                font-weight:bold;
                border:none;
                border-radius:6px;
                cursor:pointer;
            ">
                Kirim Bukti
            </button>
        </form>
    </div>

    <!-- ================= EWALLET ================= -->
    <div id="ewallet" style="display:none; margin-top:20px;">
        <h4 style="color:gold;">Pembayaran E-Wallet</h4>
        <p>DANA / OVO / GoPay</p>
        <p>Nomor: <b>081234567890</b></p>

        <form method="POST" action="?page=simpan_pembayaran" enctype="multipart/form-data">
            <input type="hidden" name="metode" value="E-Wallet">
            <input type="hidden" name="total" value="<?= $total ?>">
            <input type="hidden" name="id_reservasi" value="<?= $id_reservasi ?>">


            <label style="color:gold;">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti" required
                   style="width:100%; padding:8px; margin-top:8px; border-radius:6px;">

            <button style="
                margin-top:15px;
                width:100%;
                background:gold;
                color:black;
                padding:10px;
                font-weight:bold;
                border:none;
                border-radius:6px;
                cursor:pointer;
            ">
                Kirim Bukti
            </button>
        </form>
    </div>

    <!-- ================= CREDIT CARD ================= -->
    <div id="cc" style="display:none; margin-top:20px;">
        <h4 style="color:gold;">Credit Card</h4>

        <input type="text" placeholder="Nomor Kartu"
               style="width:100%; padding:10px; margin-bottom:10px; border-radius:6px;">
        <input type="text" placeholder="Nama di Kartu"
               style="width:100%; padding:10px; margin-bottom:10px; border-radius:6px;">
        <input type="password" placeholder="CVV"
               style="width:100%; padding:10px; border-radius:6px;">
        <input type="hidden" name="id_reservasi" value="<?= $id_reservasi ?>">


        <button style="
            margin-top:15px;
            width:100%;
            background:gold;
            color:black;
            padding:10px;
            font-weight:bold;
            border:none;
            border-radius:6px;
            cursor:pointer;
        ">
            Bayar Sekarang
        </button>
    </div>
=======
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
>>>>>>> aec976d (Menambahkan file admin)

</div>

<script>
<<<<<<< HEAD
function pilihMetode() {
    ['bank','ewallet','cc'].forEach(id =>
        document.getElementById(id).style.display = 'none'
    );

    const metode = document.getElementById('metode').value;
    if (metode) document.getElementById(metode).style.display = 'block';
=======
function pilihMetode(){
    document.querySelectorAll('.method')
        .forEach(el => el.style.display='none');
    let m = document.getElementById('metode').value;
    if(m) document.getElementById(m).style.display='block';
>>>>>>> aec976d (Menambahkan file admin)
}
</script>

</body>
</html>
