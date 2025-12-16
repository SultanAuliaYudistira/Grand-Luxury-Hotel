<!DOCTYPE html>
<html>
<head>
    <title>Register - Grand Luxury Hotel</title>
</head>
<body style="font-family:Arial;text-align:center;margin-top:80px;">

<h2>Form Registrasi</h2>
<div style="display:flex; justify-content:center; align-items:center; height:100vh;">
    <form method="POST" action="?page=register-store"
        style="background:#1b1b1b; padding:40px; border-radius:12px; width:350px; box-shadow:0 0 12px rgba(0,0,0,0.4);">

        <h2 style="margin-bottom:25px; color:gold; text-align:center;">Daftar Akun</h2>

<form method="POST" action="?page=register&aksi=store">

    <input type="text" name="nama" placeholder="Nama Lengkap" required><br><br>

    <input type="email" name="email" placeholder="Email" required><br><br>


    <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit"
            style="width:100%; padding:12px; background:gold; color:black; border:none; border-radius:6px; font-weight:bold;">
            Daftar
        </button>


    <button type="submit">Daftar</button>
</form>

<p><a href="?page=login">Sudah punya akun? Login</a></p>

</body>
</html>
