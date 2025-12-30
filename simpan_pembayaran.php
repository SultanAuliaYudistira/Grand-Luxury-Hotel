<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include __DIR__ . "/../../config/koneksi.php";

if (!isset($_SESSION['user_id'])) {
    die("Harap login terlebih dahulu");
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Akses tidak valid");
}

$id_reservasi = (int)($_POST['id_reservasi'] ?? 0);
$metode = mysqli_real_escape_string($koneksi, $_POST['metode'] ?? '');

if ($id_reservasi <= 0 || empty($metode)) {
    die("Data pembayaran tidak lengkap");
}

/* AMBIL TOTAL DARI RESERVASI */
$q = mysqli_query($koneksi, "
    SELECT total_harga 
    FROM tbl_reservasi 
    WHERE id_reservasi = $id_reservasi
    LIMIT 1
");

if (!$q || mysqli_num_rows($q) == 0) {
    die("Reservasi tidak ditemukan");
}

$res = mysqli_fetch_assoc($q);
$total = (int)$res['total_harga'];

/* UPLOAD BUKTI (WAJIB SESUAI DB) */
$folder = __DIR__ . "/../../assets/bukti/";
if (!is_dir($folder)) mkdir($folder, 0777, true);

if (!isset($_FILES['bukti']) || $_FILES['bukti']['error'] !== 0) {
    die("Bukti pembayaran wajib diupload");
}

$namaAsli = $_FILES['bukti']['name'];
$tmp = $_FILES['bukti']['tmp_name'];
$namaAman = preg_replace("/[^a-zA-Z0-9._-]/", "", $namaAsli);
$namaFile = time() . "_" . $namaAman;

if (!move_uploaded_file($tmp, $folder . $namaFile)) {
    die("Upload bukti gagal");
}

/* SIMPAN PEMBAYARAN */
$insert = mysqli_query($koneksi, "
    INSERT INTO tbl_pembayaran
    (id_reservasi, metode, jumlah, bukti, status)
    VALUES
    ($id_reservasi, '$metode', $total, '$namaFile', 'Diproses')
");

if (!$insert) {
    die("ERROR DB: " . mysqli_error($koneksi));
}

/* UPDATE STATUS RESERVASI */
mysqli_query($koneksi, "
    UPDATE tbl_reservasi
    SET status = 'Menunggu Konfirmasi'
    WHERE id_reservasi = $id_reservasi
");

/* REDIRECT KE STRUK */
header("Location: ?page=struk&id_reservasi=$id_reservasi");
exit;
