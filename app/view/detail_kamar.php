<?php
<<<<<<< HEAD
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
=======
if (session_status() === PHP_SESSION_NONE) session_start();

>>>>>>> aec976d (Menambahkan file admin)
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Harap login terlebih dahulu!'); window.location='?page=login';</script>";
    exit;
}

<<<<<<< HEAD
$kamar = $_GET["kamar"] ?? "Tidak diketahui";

$data_kamar = [
    "Standard Room" => [
        "harga" => "500.000",
        "fitur" => [
            "1 Queen Bed",
            "AC & TV",
            "Kamar Mandi Dalam",
            "Wifi Gratis"
        ],
        "img" => "assets/img/standard.jpg"
    ],

    "Deluxe Room" => [
        "harga" => "850.000",
        "fitur" => [
            "1 King Bed",
            "Bathtub",
            "City View",
            "AC, TV, Mini Bar",
            "Wifi Premium"
        ],
        "img" => "assets/img/deluxe.jpg"
    ],

    "Suite Room" => [
        "harga" => "1.500.000",
        "fitur" => [
            "1 King Bed",
            "Ruang Tamu",
            "Full Mini Bar",
            "Bathub + Shower",
            "Smart TV",
            "Wifi Super Fast"
        ],
        "img" => "assets/img/suite.jpg"
    ]
];

$detail = $data_kamar[$kamar] ?? null;
?>

<!DOCTYPE html>
<html>
<body style="font-family:Arial; background:#0e0e0e; color:white; padding:40px;">

<a href="?page=pesan" style="color:gold;">&larr; Kembali</a>

<?php if ($detail): ?>
    <h1 style="color:gold;"><?= $kamar ?></h1>

    <img src="<?= $detail['img'] ?>" style="width:400px; border-radius:12px; margin-bottom:20px;">

    <h2>Harga: Rp <?= $detail['harga'] ?> / malam</h2>

    <h3>Fasilitas:</h3>
    <ul>
        <?php foreach ($detail["fitur"] as $f): ?>
            <li><?= $f ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="?page=form_pesan&kamar=<?= urlencode($kamar) ?>" 
       style="padding:12px 20px; background:gold; color:black; text-decoration:none; border-radius:8px; font-weight:bold;">
        Pesan Sekarang
    </a>

<?php else: ?>

    <p>Kamar tidak ditemukan.</p>

<?php endif; ?>

</body>
</html>
=======
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
        'public/img/standar1.jpeg',
        'public/img/standard2.jpeg'
    ],
    'Deluxe Room' => [
        'public/img/deluxe1.jpeg',
        'public/img/deluxe2.jpeg'
    ],
    'Suite Room' => [
        'public/img/suite1.jpeg',
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
>>>>>>> aec976d (Menambahkan file admin)
