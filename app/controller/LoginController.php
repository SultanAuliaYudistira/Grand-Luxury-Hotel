<?php
class LoginController {

    public function index() {
        include "app/view/login.php";
    }

    public function auth() {
        include "config/koneksi.php";

        $email = $_POST["email"];
        $password = $_POST["password"];

        // Cek user berdasarkan email saja
        $query = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE email='$email'");
        $data = mysqli_fetch_assoc($query);

        if ($data) {

            // Cek password hashing
            if (password_verify($password, $data["password"])) {

                session_start();
                $_SESSION["user_id"] = $data["id_user"];
                $_SESSION["nama"] = $data["nama"];

                echo "<script>alert('Login berhasil!'); window.location='?page=dashboard';</script>";
            } else {
                echo "<script>alert('Password salah!'); window.location='?page=login';</script>";
            }

        } else {
            echo "<script>alert('Email tidak ditemukan'); window.location='?page=login';</script>";
        }
    }
}
?>
