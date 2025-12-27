<?php

class User
{
    // fungsi nyata: ambil user/admin berdasarkan username
    public function getByUsername($username, $table = 'tbl_admin')
    {
        require __DIR__ . '/../../config/koneksi.php';

        $query = mysqli_query(
            $koneksi,
            "SELECT * FROM {$table} WHERE username='$username'"
        );

        return mysqli_fetch_assoc($query);
    }

    // fungsi nyata: simpan user baru (register)
    public function registerUser($data)
    {
        require __DIR__ . '/../../config/koneksi.php';

        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        return mysqli_query(
            $koneksi,
            "INSERT INTO tbl_user (username, password)
             VALUES ('{$data['username']}', '$password')"
        );
    }
}
