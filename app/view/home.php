<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grand Luxury Hotel</title>

    <!-- CSS HOVER EFFECT -->
    <style>
        .facility-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            cursor: pointer;
        }
        .facility-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 18px rgba(255, 215, 0, 0.35);
        }
        .room-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            cursor: pointer;
        }
        .room-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 18px rgba(255, 215, 0, 0.35);
        }
    </style>
</head>
<body style="margin:0; font-family: Arial, sans-serif;">

<!-- NAVBAR -->
<header style="padding: 20px; display: flex; justify-content: space-between; align-items:center; background: black; color: gold;">
    <h2 style="margin: 0; font-size: 26px;">Grand Luxury Hotel</h2>
    <nav>
        <a href="?page=home" style="color: gold; margin-right: 25px; text-decoration:none; font-size:18px;">Home</a>

        <?php if(!isset($_SESSION["user_id"])) { ?>
            <a href="?page=login" style="color: gold; margin-right: 25px; text-decoration:none; font-size:18px;">Login</a>
            <a href="?page=login" style="color: black; background: gold; padding: 10px 18px; border-radius: 5px; text-decoration: none; font-weight: bold;">Pesan Sekarang</a>
        <?php } else { ?>
            <a href="?page=pesan" style="color: black; background: gold; padding: 10px 18px; border-radius: 5px; text-decoration: none; font-weight: bold; margin-right: 25px;">Pesan Sekarang</a>
            <a href="?page=riwayat" style="color: gold; margin-right: 25px; text-decoration:none; font-size:18px;">Riwayat</a>
            <a href="?page=logout" style="color: gold; text-decoration:none; font-size:18px;">Logout</a>
        <?php } ?>
    </nav>
</header>

<!-- BANNER -->
<section style="background: url('public/img/banner.jpg'); background-size: cover; background-position: center; height: 450px; display: flex; align-items: center; justify-content: center;">
    <div style="text-align: center; background: rgba(0,0,0,0.55); padding: 25px 35px; border-radius: 8px;">
        <h1 style="color: gold; font-size: 40px; margin: 0;">Experience Luxury Beyond Expectations</h1>
        <p style="color: white; margin-top: 10px; font-size: 18px;">Nikmati kenyamanan bintang lima dan pelayanan premium setiap saat.</p>

        <?php if(!isset($_SESSION["user_id"])) { ?>
            <a href="?page=login" style="margin-top: 20px; display: inline-block; background: gold; color: black; padding: 12px 25px; border-radius: 5px; font-weight: bold; text-decoration: none; font-size: 18px;">Pesan Sekarang</a>
        <?php } else { ?>
            <a href="?page=pesan" style="margin-top: 20px; display: inline-block; background: gold; color: black; padding: 12px 25px; border-radius: 5px; font-weight: bold; text-decoration: none; font-size: 18px;">Pesan Sekarang</a>
        <?php } ?>
    </div>
</section>

<!-- FASILITAS -->
<section style="padding: 80px 20px; background: #0e0e0e; text-align: center;">
    <h2 style="font-size: 42px; margin-bottom: 60px; color: gold;">Why Stay <span style="color: white;">With Us?</span></h2>

    <div style="display: flex; justify-content: center; gap: 35px; flex-wrap: wrap;">
        <div class="facility-card" style="width: 270px; background: #1b1b1b; border-radius: 14px; padding: 35px 20px; box-shadow: 0px 0px 12px rgba(0,0,0,0.4);">
            <div style="font-size: 48px; margin-bottom: 15px; color: gold;">📶</div>
            <h3 style="color: white; margin-bottom: 10px;">Free Wi-Fi</h3>
            <p style="color: #c8c8c8;">High-speed internet throughout the hotel</p>
        </div>
        <div class="facility-card" style="width: 270px; background: #1b1b1b; border-radius: 14px; padding: 35px 20px; box-shadow: 0px 0px 12px rgba(0,0,0,0.4);">
            <div style="font-size: 48px; margin-bottom: 15px; color: gold;">💦</div>
            <h3 style="color: white; margin-bottom: 10px;">Swimming Pool</h3>
            <p style="color: #c8c8c8;">Infinity pool with stunning city views</p>
        </div>
        <div class="facility-card" style="width: 270px; background: #1b1b1b; border-radius: 14px; padding: 35px 20px; box-shadow: 0px 0px 12px rgba(0,0,0,0.4);">
            <div style="font-size: 48px; margin-bottom: 15px; color: gold;">☕</div>
            <h3 style="color: white; margin-bottom: 10px;">Breakfast</h3>
            <p style="color: #c8c8c8;">Complimentary gourmet breakfast daily</p>
        </div>
        <div class="facility-card" style="width: 270px; background: #1b1b1b; border-radius: 14px; padding: 35px 20px; box-shadow: 0px 0px 12px rgba(0,0,0,0.4);">
            <div style="font-size: 48px; margin-bottom: 15px; color: gold;">⏰</div>
            <h3 style="color: white; margin-bottom: 10px;">24/7 Service</h3>
            <p style="color: #c8c8c8;">Round-the-clock concierge at your service</p>
        </div>
    </div>
</section>

<!-- TIPE KAMAR -->
<section style="padding: 80px 20px; background: #0e0e0e; text-align: center;">
    <h2 style="font-size: 42px; margin-bottom: 60px; color: gold;">Our <span style="color:white;">Rooms & Suites</span></h2>

    <div style="display: flex; justify-content: center; gap: 35px; flex-wrap:wrap;">
        <div class="room-card" style="width: 300px; background: #1b1b1b; border-radius: 14px; overflow: hidden; box-shadow: 0px 0px 12px rgba(0,0,0,0.4); color:white;">
            <img src="public/img/standard.jpg" width="300" height="190">
            <h3 style="margin-top: 15px;">Standard Room</h3>
            <p style="padding: 0 15px; color:#c8c8c8;">Kamar standar dengan kenyamanan terbaik dan harga terjangkau.</p>
            <a href="<?php echo isset($_SESSION['user_id']) ? '?page=pesan' : '?page=login'; ?>" style="display: block; margin: 15px; background: gold; color:black; padding: 12px; border-radius: 5px; font-weight: bold; text-decoration: none;">Lihat Kamar</a>
        </div>

        <div class="room-card" style="width: 300px; background: #1b1b1b; border-radius: 14px; overflow: hidden; box-shadow: 0px 0px 12px rgba(0,0,0,0.4); color:white;">
            <img src="public/img/deluxe.jpg" width="300" height="190">
            <h3 style="margin-top: 15px;">Deluxe Room</h3>
            <p style="padding: 0 15px; color:#c8c8c8;">Lebih luas, fasilitas premium & cocok untuk keluarga atau liburan panjang.</p>
            <a href="<?php echo isset($_SESSION['user_id']) ? '?page=pesan' : '?page=login'; ?>" style="display: block; margin: 15px; background: gold; color:black; padding: 12px; border-radius: 5px; font-weight: bold; text-decoration: none;">Lihat Kamar</a>
        </div>

        <div class="room-card" style="width: 300px; background: #1b1b1b; border-radius: 14px; overflow: hidden; box-shadow: 0px 0px 12px rgba(0,0,0,0.4); color:white;">
            <img src="public/img/suite.jpg" width="300" height="190">
            <h3 style="margin-top: 15px;">Suite Room</h3>
            <p style="padding: 0 15px; color:#c8c8c8;">Kamar mewah dengan ruang tamu & fasilitas terbaik untuk pengalaman tak terlupakan.</p>
            <a href="<?php echo isset($_SESSION['user_id']) ? '?page=pesan' : '?page=login'; ?>" style="display: block; margin: 15px; background: gold; color:black; padding: 12px; border-radius: 5px; font-weight: bold; text-decoration: none;">Lihat Kamar</a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer style="padding: 60px; background: black; color: gold;">
    <div style="display: flex; justify-content: space-between; max-width: 1200px; margin: auto; flex-wrap: wrap;">
        <div style="width: 250px; margin-bottom: 20px;">
            <h3 style="margin: 0 0 15px 0;">Grand Luxury Hotel</h3>
            <p style="color: white;">Experience unparalleled luxury and comfort in the heart of the city. Your home away from home.</p>
        </div>
        <div style="width: 250px; margin-bottom: 20px;">
            <h3 style="margin: 0 0 15px 0;">Contact Us</h3>
            <p style="color: white;">📍 123 Luxury Avenue, Downtown District<br>Jakarta, Indonesia 12345</p>
            <p style="color: white;">📞 +62 21 1234 5678</p>
            <p style="color: white;">✉ info@grandluxuryhotel.com</p>
        </div>
        <div style="width: 250px; margin-bottom: 20px;">
            <h3 style="margin: 0 0 15px 0;">Quick Links</h3>
            <p><a href="?page=home" style="color: gold; text-decoration:none;">About Us</a></p>
            <p><a href="?page=login" style="color: gold; text-decoration:none;">Rooms & Suites</a></p>
            <p><a href="?page=login" style="color: gold; text-decoration:none;">Dining</a></p>
            <p><a href="?page=login" style="color: gold; text-decoration:none;">Amenities</a></p>
            <p><a href="?page=login" style="color: gold; text-decoration:none;">Contact</a></p>
        </div>
        <div style="width: 250px; margin-bottom: 20px;">
            <h3 style="margin: 0 0 15px 0;">Follow Us</h3>
            <p style="color: white;">Stay connected for exclusive offers and updates.</p>
            <div style="display: flex; gap: 12px; font-size: 22px;">
                <a href="#" style="color: gold;">🌐</a>
                <a href="#" style="color: gold;">📸</a>
                <a href="#" style="color: gold;">🐦</a>
                <a href="#" style="color: gold;">💼</a>
            </div>
        </div>
    </div>

    <p style="color: white; text-align: center; margin-top: 35px; font-size: 14px;">
        © 2025 Grand Luxury Hotel. All rights reserved. | Designed with excellence.
    </p>
</footer>

</body>
</html>
