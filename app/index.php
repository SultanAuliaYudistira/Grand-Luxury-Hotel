<?php
session_start();
include "config/koneksi.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch($page){

    // ===== HOME =====
    case "home":
        include "app/view/home.php";
        break;

    // ===== LOGIN VIEW =====
    case "login":
        include "app/controller/LoginController.php";
        $ctrl = new LoginController();
        $ctrl->index();
        break;

    // ===== LOGIN PROCESS =====
    case "login-auth":
        include "app/controller/LoginController.php";
        $ctrl = new LoginController();
        $ctrl->auth();
        break;

    // ===== REGISTER VIEW =====
    case "register":
        include "app/controller/RegisterController.php";
        $ctrl = new RegisterController();
        $ctrl->index();
        break;

    // ===== REGISTER PROCESS =====
    case "register-store":
        include "app/controller/RegisterController.php";
        $ctrl = new RegisterController();
        $ctrl->store();
        break;

    // ===== DASHBOARD (setelah login) =====
    case "dashboard":
        include "app/view/home.php";
        break;

    // ===== MENU LAIN =====
    case "pesan":
        include "app/view/pesan.php";
        break;

    case "form_pesan":
        include "app/view/form_pesan.php";
        break;

    case "riwayat":
        include "app/view/riwayat.php";
        break;

    // ===== LOGOUT =====
    case "logout":
        session_destroy();
        echo "<script>window.location='?page=home';</script>";
        break;

    // DEFAULT
    default:
        include "app/view/home.php";
        break;
}
