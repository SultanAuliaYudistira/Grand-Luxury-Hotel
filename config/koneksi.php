<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_grand_luxury");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
