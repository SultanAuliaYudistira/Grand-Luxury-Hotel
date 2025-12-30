<?php
class RegisterController {
public function store() {
    session_start();
    include "config/koneksi.php";

    $id_user = $_SESSION["user_id"];
    $tipe_kamar = $_POST["tipe_kamar"];
    $check_in = $_POST["check_in"];
    $check_out = $_POST["check_out"];
    $jumlah_tamu = $_POST["jumlah_tamu"];

    
    $q = mysqli_query($koneksi, "SELECT id_kamar FROM tbl_kamar 
                                 INNER JOIN tbl_tipe_kamar ON tbl_tipe_kamar.id_tipe = tbl_kamar.id_tipe
                                 WHERE nama_tipe = '$tipe_kamar' LIMIT 1");

    $kamar = mysqli_fetch_assoc($q);

    if (!$kamar) {
        echo "<script>alert('Kamar tidak ditemukan!'); window.location='?page=pesan';</script>";
        exit;
    }

    $id_kamar = $kamar["id_kamar"];

    
    $query = mysqli_query($koneksi, "
        INSERT INTO tbl_reservasi(id_user, id_kamar, tipe_kamar, tanggal_checkin, tanggal_checkout, jumlah_tamu, status)
        VALUES('$id_user', '$id_kamar', '$tipe_kamar', '$check_in', '$check_out', '$jumlah_tamu', 'Menunggu Pembayaran')
    ");

    if ($query) {
        echo "<script>alert('Pemesanan berhasil!'); window.location='?page=riwayat';</script>";
    } else {
        echo "<script>alert('Pemesanan gagal!'); window.location='?page=pesan';</script>";
    }
}
}
?>
