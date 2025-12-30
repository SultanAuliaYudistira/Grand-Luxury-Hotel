<?php
class AdminAuthController
{
    public function index()
    {
        require_once __DIR__ . '/../view/admin/login.php';
    }

    public function auth()
    {
        require_once __DIR__ . '/../../config/koneksi.php';

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $query = mysqli_query(
            $koneksi,
            "SELECT * FROM tbl_admin WHERE username='$username'"
        );

        $admin = mysqli_fetch_assoc($query);

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin['id_admin'];

            header("Location: admin_dashboard.php");
            exit;
        } else {
            echo "<script>
                alert('Username atau password salah');
                window.location='admin.php';
            </script>";
        }
    }
}
