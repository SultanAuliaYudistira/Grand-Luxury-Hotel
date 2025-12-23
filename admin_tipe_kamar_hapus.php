<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}
include "config/koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM tbl_tipe_kamar WHERE id_tipe='$id'");

header("Location: admin_tipe_kamar.php");
