<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "config/koneksi.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {

    /* ================= USER ================= */

    case "home":
        include "app/view/home.php";
        break;

    case "login":
        include "app/controller/LoginController.php";
        $ctrl = new LoginController();
        if (isset($_GET["aksi"])) {
            $ctrl->auth();
        } else {
            $ctrl->index();
        }
        break;

    case "register":
        include "app/controller/RegisterController.php";
        $ctrl = new RegisterController();
        if (isset($_GET["aksi"])) {
            $ctrl->store();
        } else {
            $ctrl->index();
        }
        break;

    case "dashboard":
        include "app/view/home.php";
        break;

    case "pesan":
        include "app/view/pesan.php";
        break;

    case "form_pesan":
        include "app/view/form_pesan.php";
        break;

    case "proses_pemesanan":
        include "app/view/proses_pemesanan.php";
        break;

    case "Pembayaran":
        include "app/view/Pembayaran.php";
        break;

    case "riwayat":
        include "app/view/riwayat.php";
        break;

    case "detail_kamar":
        include "app/view/detail_kamar.php";
        break;

    case "simpan_pembayaran":
        include "app/view/simpan_pembayaran.php";
        break;

    case "struk":
        include "app/view/struk.php";
        break;

    /* ================= ADMIN ================= */

    case "admin-login":
        include "app/controller/AdminAuthController.php";
        $ctrl = new AdminAuthController();
        if (isset($_GET["aksi"])) {
            $ctrl->auth();
        } else {
            $ctrl->index();
        }
        break;

    case "admin-dashboard":
        include "app/controller/AdminController.php";
        (new AdminController())->dashboard();
        break;

    case "admin-kamar":
        include "app/controller/KamarController.php";
        (new KamarController())->index();
        break;

    case "admin-reservasi":
        include "app/controller/ReservasiAdminController.php";
        (new ReservasiAdminController())->index();
        break;

    case "admin-pembayaran":
        include "app/controller/PembayaranAdminController.php";
        (new PembayaranAdminController())->index();
        break;

    case "admin-laporan":
        include "app/controller/LaporanController.php";
        (new LaporanController())->index();
        break;

    /* ================= LOGOUT ================= */

    case "logout":
        session_destroy();
        echo "<script>window.location='?page=home';</script>";
        break;

    default:
        include "app/view/home.php";
        break;
}
