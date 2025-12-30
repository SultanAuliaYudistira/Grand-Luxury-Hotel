<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <style>
        /* ===== RESET ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        /* ===== BODY ===== */
        body {
            height: 100vh;
            background: radial-gradient(circle at top, #222 0%, #000 75%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* ===== TITLE ===== */
        h2 {
            color: #FFD700;
            margin-bottom: 20px;
        }

        /* ===== FORM ===== */
        form {
            background: #1b1b1b;
            width: 350px;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 0 25px rgba(255, 215, 0, 0.15);
        }

        label {
            color: #ddd;
            font-size: 13px;
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #FFD700;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #ffea70;
        }
    </style>
</head>

<body>

    <h2>Login Admin</h2>

    <form method="post" action="admin.php?aksi=login">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

</body>
</html>
