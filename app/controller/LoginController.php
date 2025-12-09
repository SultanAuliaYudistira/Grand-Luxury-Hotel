<?php
class LoginController {

    // Tampilkan halaman login
    public function index() {
        include "app/view/login.php";
    }

    // Proses login
    public function auth() {
        include "config/koneksi.php"; // koneksi database

        $email = $_POST["email"];
        $password = $_POST["password"];

        $query = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE email='$email' AND password='$password'");
        $data = mysqli_fetch_array($query);

        if ($data) {
            session_start();
            $_SESSION["user_id"] = $data["id_user"];
            $_SESSION["nama"] = $data["nama"];

            echo "<script>alert('Login berhasil!'); window.location='?page=dashboard';</script>";
        } else {
            echo "<script>alert('Email atau Password salah!'); window.location='?page=login';</script>";
        }
    }
}
?>
