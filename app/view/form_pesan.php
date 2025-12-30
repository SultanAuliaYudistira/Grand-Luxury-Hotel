<?php
<<<<<<< HEAD
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek login
=======
if (session_status() === PHP_SESSION_NONE) session_start();

>>>>>>> aec976d (Menambahkan file admin)
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Harap login terlebih dahulu!'); window.location='?page=login';</script>";
    exit;
}

<<<<<<< HEAD
// Ambil tipe kamar dari URL
$kamar = isset($_GET["kamar"]) ? $_GET["kamar"] : "Tidak diketahui";

// Tentukan harga per kamar
$harga = 0;
if ($kamar == "Standard Room") $harga = 500000;
if ($kamar == "Deluxe Room") $harga = 750000;
if ($kamar == "Suite Room") $harga = 1000000;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan - Grand Luxury Hotel</title>
</head>

<body style="font-family:Arial; background:#0e0e0e; color:white; margin:0; padding:40px;">

<h1 style="text-align:center; color:gold; margin-bottom:30px;">
    Form Pemesanan Kamar
</h1>

<div style="display:flex; justify-content:center; gap:40px; align-items:flex-start;">

    <!-- Gambar Hotel -->
    <div>
        <img src="assets/hotel.jpg" alt="Hotel"
             style="width:350px; border-radius:12px; box-shadow:0 0 10px rgba(255,255,255,0.2);">
    </div>

    <!-- Form -->
    <div style="
        width:430px; 
        background:#1b1b1b; 
        padding:25px; 
        border-radius:12px;
        box-shadow:0 0 10px rgba(255,255,255,0.1);
    ">

        <form method="POST" action="?page=Pembayaran" style="width:400px;margin:auto;">

<label>Nama</label>
<input type="text" name="nama" required style="width:100%;padding:10px;"><br><br>

<label>No HP</label>
<input type="text" name="no_hp" maxlength="13" required
       oninput="this.value=this.value.replace(/[^0-9]/g,'')"
       style="width:100%;padding:10px;"><br><br>

<label>Check-In</label>
<input type="date" id="in" required style="width:100%;padding:10px;"><br><br>

<label>Check-Out</label>
<input type="date"  id="out" required style="width:100%;padding:10px;"><br><br>

<label>Jumlah Orang</label>
<input type="number" name="orang" id="orang" min="1" value="1"
       style="width:100%;padding:10px;"><br><br>

<label>Total</label>
<input type="text" id="total_view" readonly style="width:100%;padding:10px;"><br><br>

<!-- TOTAL ANGKA MURNI -->
<input type="hidden" name="total" id="total">

<button type="submit" style="width:100%;background:gold;padding:12px;font-weight:bold;">
Pesan Sekarang
</button>

</form>
    </div>
</div>


<script>
const harga = <?= $harga ?>;

function hitung(){
 let i=document.getElementById('in').value;
 let o=document.getElementById('out').value;
 let j=document.getElementById('orang').value;
 if(!i||!o) return;

 let m=(new Date(o)-new Date(i))/(1000*60*60*24);
 if(m<1) return;

 let total=m*harga*j;
 document.getElementById('total_view').value="Rp "+total.toLocaleString('id-ID');
 document.getElementById('total').value=total;
}

['in','out','orang'].forEach(id=>{
 document.getElementById(id).addEventListener('change',hitung);
});
</script>


=======
include __DIR__ . "/../../config/koneksi.php";

$id_kamar = isset($_GET['id_kamar']) ? (int)$_GET['id_kamar'] : 0;
if ($id_kamar <= 0) {
    echo "<script>alert('Kamar tidak valid');window.location='?page=pesan';</script>";
    exit;
}

$query = mysqli_query($koneksi, "
    SELECT 
        k.id_kamar,
        k.nama_kamar,
        k.nomor_kamar,
        k.status,
        k.foto,
        t.id_tipe,
        t.nama_tipe,
        t.harga,
        t.stok
    FROM tbl_kamar k
    JOIN tbl_tipe_kamar t ON k.id_tipe = t.id_tipe
    WHERE k.id_kamar = $id_kamar
");

$kamar = mysqli_fetch_assoc($query);
if (!$kamar) {
    echo "<script>alert('Data kamar tidak ditemukan');window.location='?page=pesan';</script>";
    exit;
}

if ($kamar['stok'] <= 0) {
    echo "<script>alert('Stok kamar untuk tipe ini sudah habis');window.location='?page=pesan';</script>";
    exit;
}


if ($kamar['status'] !== 'Tersedia') {
    echo "<script>alert('Kamar sedang tidak tersedia');window.location='?page=pesan';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Form Pemesanan</title>

<style>
body{background:#0e0e0e;color:white;font-family:Arial;}
.wrapper{max-width:1100px;margin:40px auto;}
.grid{display:grid;grid-template-columns:1fr 1fr;gap:40px;}
.card{background:#1b1b1b;border-radius:16px;padding:25px;}
.card img{width:100%;height:260px;object-fit:cover;border-radius:16px;}
h1,h2{color:gold;}
label{display:block;margin-top:15px;}
input{width:100%;padding:12px;border-radius:8px;border:none;}
button{
    margin-top:25px;
    width:100%;
    padding:14px;
    background:gold;
    font-weight:bold;
    border:none;
    border-radius:10px;
    cursor:pointer;
}
@media(max-width:900px){.grid{grid-template-columns:1fr;}}
</style>
</head>

<body>

<div class="wrapper">
<h1>Form Pemesanan</h1>

<div class="grid">

<!-- INFO KAMAR -->
<div class="card">
    <img src="public/img/<?= $kamar['foto'] ?: 'default.jpg'; ?>">
    <h2><?= $kamar['nama_kamar']; ?></h2>
    <p>Tipe: <?= $kamar['nama_tipe']; ?></p>
    <p>Nomor: <?= $kamar['nomor_kamar']; ?></p>
    <p>Harga: Rp <?= number_format($kamar['harga'],0,',','.'); ?> / malam</p>
</div>

<!-- FORM -->
<div class="card">
<form method="POST" action="?page=proses_pemesanan">

    <input type="hidden" name="id_kamar" value="<?= $kamar['id_kamar']; ?>">
    <input type="hidden" name="harga" value="<?= $kamar['harga']; ?>">
    <input type="hidden" name="total" id="total">
    <input type="hidden" name="id_tipe" value="<?= $kamar['id_tipe']; ?>">


    <label>Nama</label>
    <input type="text" name="nama" required>

    <label>No HP</label>
    <input type="text" name="no_hp" required
           oninput="this.value=this.value.replace(/[^0-9]/g,'')">

    <label>Check-in</label>
    <input type="date" name="checkin" id="in" required>

    <label>Check-out</label>
    <input type="date" name="checkout" id="out" required>

    <label>Jumlah Kamar</label>
    <input type="number" name="jumlah" id="jumlah"
       min="1" max="<?= $kamar['stok']; ?>" value="1" required>
    <small>Stok kamar tersedia: <?= $kamar['stok']; ?></small>


    <label>Total</label>
    <input type="text"x id="total_view" readonly>

    <button type="submit">Pesan Sekarang</button>
</form>
</div>

</div>
</div>

<script>
const harga = <?= $kamar['harga']; ?>;
const checkIn  = document.getElementById('in');
const checkOut = document.getElementById('out');
const jumlah   = document.getElementById('jumlah');
const totalView = document.getElementById('total_view');
const totalInput = document.getElementById('total');

function hitungTotal(){
    if(!checkIn.value || !checkOut.value) return;

    let malam = (new Date(checkOut.value) - new Date(checkIn.value)) / (1000*60*60*24);
    if(malam < 1){
        totalView.value = '';
        totalInput.value = '';
        return;
    }

    let total = malam * harga * jumlah.value;
    totalView.value = "Rp " + total.toLocaleString('id-ID');
    totalInput.value = total;
}

checkIn.addEventListener('change', hitungTotal);
checkOut.addEventListener('change', hitungTotal);
jumlah.addEventListener('change', hitungTotal);
</script>

>>>>>>> aec976d (Menambahkan file admin)
</body>
</html>
