<?php
class RegisterController {

    public function index() {
        include "app/view/register.php";
    }

    public function store() {
        include "config/koneksi.php";

        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Enkripsi password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah email sudah terdaftar
        $cek = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE email='$email'");
        if (mysqli_num_rows($cek) > 0) {
            echo "<script>alert('Email sudah digunakan!'); window.location='?page=register';</script>";
            return;
        }

        $query = mysqli_query($koneksi,
            "INSERT INTO tbl_user(nama, email, password) VALUES ('$nama', '$email', '$hash')"
        );

        if ($query) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='?page=login';</script>";
        } else {
            echo "<script>alert('Registrasi gagal!'); window.location='?page=register';</script>";
        }
    }
}
?>
