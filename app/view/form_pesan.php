<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek login
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Harap login terlebih dahulu!'); window.location='?page=login';</script>";
    exit;
}

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


</body>
</html>
