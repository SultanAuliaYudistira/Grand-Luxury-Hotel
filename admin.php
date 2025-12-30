<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// panggil controller admin
require_once __DIR__ . "/app/controller/AdminAuthController.php";

// tentukan aksi
$aksi = $_GET['aksi'] ?? null;

// buat objek controller
$ctrl = new AdminAuthController();

// routing sederhana
if ($aksi === 'login') {
    $ctrl->auth();
} else {
    $ctrl->index();
}
