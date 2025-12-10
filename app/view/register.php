<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Grand Luxury Hotel</title>
</head>
<body style="font-family: Arial; background: #0e0e0e; color:white; margin:0;">

<div style="display:flex; justify-content:center; align-items:center; height:100vh;">
    <form method="POST" action="?page=register-store"
        style="background:#1b1b1b; padding:40px; border-radius:12px; width:350px; box-shadow:0 0 12px rgba(0,0,0,0.4);">

        <h2 style="margin-bottom:25px; color:gold; text-align:center;">Daftar Akun</h2>

        <label>Nama Lengkap</label>
        <input type="text" name="nama" required
            style="width:100%; padding:10px; margin-top:6px; margin-bottom:18px; border-radius:6px; border:none;">

        <label>Email</label>
        <input type="email" name="email" required
            style="width:100%; padding:10px; margin-top:6px; margin-bottom:18px; border-radius:6px; border:none;">

        <label>Password</label>
        <input type="password" name="password" required
            style="width:100%; padding:10px; margin-top:6px; margin-bottom:25px; border-radius:6px; border:none;">

        <button type="submit"
            style="width:100%; padding:12px; background:gold; color:black; border:none; border-radius:6px; font-weight:bold;">
            Daftar
        </button>

        <p style="margin-top:20px; text-align:center;">Sudah punya akun? 
            <a href="?page=login" style="color:gold;">Login</a>
        </p>
    </form>
</div>

</body>
</html>
