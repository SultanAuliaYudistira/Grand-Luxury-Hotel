<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Harap login terlebih dahulu!'); window.location='?page=login';</script>";
    exit;
}

include __DIR__ . "/../../config/koneksi.php";

$kamar = mysqli_query($koneksi, "
    SELECT 
        k.id_kamar,
        k.nama_kamar,
        k.nomor_kamar,
        k.status,
        k.foto,
        t.nama_tipe,
        t.harga,
        t.stok
    FROM tbl_kamar k
    JOIN tbl_tipe_kamar t ON k.id_tipe = t.id_tipe
    WHERE k.status = 'Tersedia'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pilih Kamar</title>
</head>

<body style="font-family:Arial;background:#0e0e0e;color:white;padding:40px;">

<h1 style="text-align:center;color:gold;">Pilih Kamar</h1>

<div style="display:flex;gap:30px;justify-content:center;flex-wrap:wrap;">

<?php while($row = mysqli_fetch_assoc($kamar)): ?>
<div style="background:#1b1b1b;width:300px;padding:18px;border-radius:12px;text-align:center;">

    <img src="public/img/<?= $row['foto'] ?: 'default.jpg'; ?>" 
         style="width:100%;border-radius:12px;">

    <h2 style="color:gold;"><?= $row['nama_kamar']; ?></h2>
    <p>Tipe: <?= $row['nama_tipe']; ?></p>
    <p>Nomor: <?= $row['nomor_kamar']; ?></p>
    <p>Harga: Rp <?= number_format($row['harga'],0,',','.'); ?> / malam</p>

    <p>
        Stok: 
        <b style="color:<?= $row['stok'] > 0 ? 'gold' : 'red'; ?>">
            <?= $row['stok'] > 0 ? $row['stok'] : 'Habis'; ?>
        </b>
    </p>

    <?php if($row['stok'] > 0): ?>
        <a href="?page=form_pesan&id_kamar=<?= $row['id_kamar']; ?>"
           style="background:gold;color:black;padding:8px 12px;
           border-radius:6px;font-weight:bold;text-decoration:none;">
           Pesan
        </a>
    <?php else: ?>
        <span style="background:#555;color:#aaa;padding:8px 12px;
              border-radius:6px;display:inline-block;">
            Stok Habis
        </span>
    <?php endif; ?>

    <a href="?page=detail_kamar&id_kamar=<?= $row['id_kamar']; ?>"
       style="background:#444;color:white;padding:8px 12px;
       border-radius:6px;text-decoration:none;margin-top:10px;display:inline-block;">
       Detail
    </a>

</div>
<?php endwhile; ?>

</div>
</body>
</html>
