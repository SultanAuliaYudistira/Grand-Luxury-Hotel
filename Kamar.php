<?php

class Kamar
{
    // fungsi nyata: ambil semua data kamar
    public function getAll()
    {
        require __DIR__ . '/../../config/koneksi.php';

        return mysqli_query(
            $koneksi,
            "SELECT * FROM kamar"
        );
    }

    // fungsi nyata: ambil detail kamar
    public function getById($id_kamar)
    {
        require __DIR__ . '/../../config/koneksi.php';

        $query = mysqli_query(
            $koneksi,
            "SELECT * FROM kamar WHERE id_kamar='$id_kamar'"
        );

        return mysqli_fetch_assoc($query);
    }
}
