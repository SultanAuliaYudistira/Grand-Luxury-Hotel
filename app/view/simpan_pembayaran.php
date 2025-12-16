<?php
// ================= SESSION =================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . "/../../config/koneksi.php";

// ================= CEK LOGIN =================
if (!isset($_SESSION['user_id'])) {
    die("Harap login terlebih dahulu");
}

// ================= VALIDASI POST =================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Akses tidak valid");
}

if (!isset($_POST['id_reservasi'])) {
    die("Reservasi tidak ditemukan");
}

$id_reservasi = (int) $_POST['id_reservasi'];
$metode       = $_POST['metode'];
$total        = (int) $_POST['total'];

// ================= UPLOAD BUKTI =================
$folder = __DIR__ . "/../../assets/bukti/";

// buat folder jika belum ada
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

// cek file
if (!isset($_FILES['bukti']) || $_FILES['bukti']['error'] !== 0) {
    die("File bukti tidak valid");
}

// amankan nama file
$namaAsli = $_FILES['bukti']['name'];
$tmpFile  = $_FILES['bukti']['tmp_name'];

$namaAman = preg_replace("/[^a-zA-Z0-9._-]/", "", $namaAsli);
$namaBaru = time() . "_" . $namaAman;

// pindahkan file
if (!move_uploaded_file($tmpFile, $folder . $namaBaru)) {
    die("Upload bukti pembayaran gagal");
}

// ================= SIMPAN KE DATABASE =================

// simpan pembayaran
mysqli_query($koneksi, "
    INSERT INTO tbl_pembayaran 
    (id_reservasi, metode, total_bayar, bukti, tanggal_bayar)
    VALUES
    ('$id_reservasi', '$metode', '$total', '$namaBaru', NOW())
");

// update status reservasi
mysqli_query($koneksi, "
    UPDATE tbl_reservasi
    SET status = 'Lunas'
    WHERE id_reservasi = '$id_reservasi'
");

// ================= AMBIL DATA STRUK =================
$q = mysqli_query($koneksi, "
    SELECT 
        r.tipe_kamar,
        r.tanggal_checkin,
        r.tanggal_checkout,
        r.jumlah_tamu,
        r.total_harga,
        r.status,
        p.metode,
        p.tanggal_bayar
    FROM tbl_reservasi r
    LEFT JOIN tbl_pembayaran p 
        ON r.id_reservasi = p.id_reservasi
    WHERE r.id_reservasi = '$id_reservasi'
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
</head>

<body style="background:#0e0e0e; font-family:Arial; padding:40px; color:white;">

<a href="?page=home" style="color:gold;">&larr; Kembali</a>

<h1 style="text-align:center; color:gold;">STRUK PEMBAYARAN</h1>

<div style="
    width:430px;
    margin:auto;
    background:#1b1b1b;
    padding:25px;
    border-radius:12px;
    box-shadow:0 0 10px rgba(255,255,255,0.1);
">

    <p><b>Hotel :</b> Grand Luxury Hotel</p>
    <p><b>Tipe Kamar :</b> <?= htmlspecialchars($data['tipe_kamar']) ?></p>
    <p><b>Check-In :</b> <?= $data['tanggal_checkin'] ?></p>
    <p><b>Check-Out :</b> <?= $data['tanggal_checkout'] ?></p>
    <p><b>Jumlah Tamu :</b> <?= $data['jumlah_tamu'] ?></p>
    <p><b>Metode Pembayaran :</b> <?= $data['metode'] ?></p>
    <p><b>Tanggal Bayar :</b> <?= $data['tanggal_bayar'] ?></p>

    <hr style="border:1px solid gold;">

    <h2 style="color:gold;">
        Total : Rp <?= number_format($data['total_harga']) ?>
    </h2>

    <p style="color:lime; font-weight:bold;">
        STATUS : <?= strtoupper($data['status']) ?>
    </p>

    <div style="text-align:center; margin-top:20px;">
        <a href="?page=riwayat"
           style="background:gold; color:black; padding:10px 22px;
                  border-radius:6px; text-decoration:none; font-weight:bold;">
            Lihat Riwayat
        </a>
    </div>

</div>

</body>
</html>
