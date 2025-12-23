<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Harap login terlebih dahulu!'); window.location='?page=login';</script>";
    exit;
}

include __DIR__ . "/../../config/koneksi.php";

$id_kamar = isset($_GET['id_kamar']) ? (int)$_GET['id_kamar'] : 0;
if ($id_kamar <= 0) {
    echo "Kamar tidak ditemukan";
    exit;
}

$query = mysqli_query($koneksi, "
    SELECT 
        k.id_kamar,
        k.nama_kamar,
        k.nomor_kamar,
        k.foto,
        t.nama_tipe,
        t.harga,
        t.deskripsi
    FROM tbl_kamar k
    JOIN tbl_tipe_kamar t ON k.id_tipe = t.id_tipe
    WHERE k.id_kamar = $id_kamar
");

$detail = mysqli_fetch_assoc($query);
if (!$detail) {
    echo "Data kamar tidak ditemukan";
    exit;
}

$slider_images = [
    'Standard Room' => [
        'public/img/standard1.jpg',
        'public/img/standard2.jpeg'
    ],
    'Deluxe Room' => [
        'public/img/deluxe1.jpg',
        'public/img/deluxe2.jpeg'
    ],
    'Suite Room' => [
        'public/img/suite1.jpg',
        'public/img/suite2.jpeg'
    ]
];

$images = $slider_images[$detail['nama_tipe']] ?? ['public/img/default.jpg'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail <?= $detail['nama_kamar']; ?></title>

<style>
body{
    background:#0e0e0e;
    color:white;
    font-family:Arial;
    padding:40px;
}
.container{
    display:flex;
    gap:40px;
    max-width:1100px;
    margin:auto;
}
.slider{
    width:50%;
    position:relative;
}
.slide{
    display:none;
    width:100%;
    height:320px;
    object-fit:cover;
    border-radius:14px;
}
.slide.active{
    display:block;
}
.nav{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    background:rgba(0,0,0,0.55);
    color:white;
    border:none;
    font-size:28px;
    padding:10px 14px;
    cursor:pointer;
    border-radius:50%;
}
.nav.left{left:12px}
.nav.right{right:12px}
.nav:hover{
    background:gold;
    color:black;
}

.detail{width:50%}
h1{color:gold}
.price{
    font-size:22px;
    margin:10px 0;
}
button{
    margin-top:20px;
    padding:14px 25px;
    background:gold;
    border:none;
    border-radius:8px;
    font-weight:bold;
    cursor:pointer;
}
a.back{
    color:gold;
    text-decoration:none;
}

.detail ul{
    margin-top:10px;
    padding-left:20px;
}
.detail ul li{
    margin-bottom:6px;
    color:#ddd;
}
</style>
</head>

<body>

<a href="?page=pesan" class="back">&larr; Kembali</a>

<div class="container">

    <!-- SLIDER -->
    <div class="slider">
        <button class="nav left" onclick="prevSlide()">&#10094;</button>

        <?php foreach ($images as $i => $img): ?>
            <img src="<?= $img ?>" class="slide <?= $i === 0 ? 'active' : '' ?>">
        <?php endforeach; ?>

        <button class="nav right" onclick="nextSlide()">&#10095;</button>
    </div>

    <!-- DETAIL -->
    <div class="detail">
        <h1><?= $detail['nama_kamar']; ?></h1>
        <p>Tipe: <?= $detail['nama_tipe']; ?></p>
        <p>Nomor Kamar: <?= $detail['nomor_kamar']; ?></p>

        <div class="price">
            Rp <?= number_format($detail['harga'],0,',','.'); ?> / malam
        </div>

        <h3>Deskripsi & Fasilitas</h3>
        <div class="deskripsi">
            <?= $detail['deskripsi']; ?>
        </div>

        <a href="?page=form_pesan&id_kamar=<?= $detail['id_kamar']; ?>">
            <button>Pesan Sekarang</button>
        </a>
    </div>

</div>

<script>
let index = 0;
const slides = document.querySelectorAll(".slide");

function showSlide(i){
    slides.forEach(s => s.classList.remove("active"));
    slides[i].classList.add("active");
}
function nextSlide(){
    index = (index + 1) % slides.length;
    showSlide(index);
}
function prevSlide(){
    index = (index - 1 + slides.length) % slides.length;
    showSlide(index);
}
</script>

</body>
</html>