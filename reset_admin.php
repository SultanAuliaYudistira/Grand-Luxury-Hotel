<?php
require_once __DIR__ . "/config/koneksi.php";

$hash = password_hash('admin123', PASSWORD_DEFAULT);

$sql = "UPDATE tbl_admin SET password='$hash' WHERE username='admin'";
if (mysqli_query($koneksi, $sql)) {
    echo "RESET BERHASIL<br>";
    echo "USERNAME: admin<br>";
    echo "PASSWORD: admin123<br>";
    echo "HASH: $hash";
} else {
    echo "GAGAL: " . mysqli_error($koneksi);
}
