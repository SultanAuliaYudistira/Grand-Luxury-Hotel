<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

include "config/koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM tbl_kamar WHERE id_kamar='$id'");

header("Location: admin_kamar.php");
exit;
