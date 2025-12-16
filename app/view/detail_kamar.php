<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Harap login terlebih dahulu!'); window.location='?page=login';</script>";
    exit;
}

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
