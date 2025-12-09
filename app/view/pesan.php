<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Harap login terlebih dahulu!'); window.location='?page=login';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pilih Kamar - Grand Luxury Hotel</title>
</head>
<body style="font-family: Arial; background:#0e0e0e; color:white; margin:0; padding:40px;">

<h1 style="text-align:center; color:gold; margin-bottom:30px;">Pilih Kamar</h1>

<div style="display:flex; justify-content:center; gap:35px;">

    <!-- Standard Room -->
    <div style="background:#1b1b1b; width:280px; border-radius:12px; padding:18px; text-align:center;">
        <img src="assets/img/standard.jpg" style="width:100%; border-radius:12px;">
        <h2 style="margin:15px 0; color:gold;">Standard Room</h2>
        <p>Rp 500.000 / malam</p>
        <a href="?page=form_pesan&kamar=Standard Room" 
           style="display:block; margin-top:15px; background:gold; color:black; padding:10px; border-radius:6px; font-weight:bold; text-decoration:none;">
           Pilih
        </a>
    </div>

    <!-- Deluxe Room -->
    <div style="background:#1b1b1b; width:280px; border-radius:12px; padding:18px; text-align:center;">
        <img src="assets/img/deluxe.jpg" style="width:100%; border-radius:12px;">
        <h2 style="margin:15px 0; color:gold;">Deluxe Room</h2>
