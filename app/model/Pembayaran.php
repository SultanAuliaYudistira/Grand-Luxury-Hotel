<?php

class Pembayaran
{
    // fungsi nyata: simpan pembayaran
    public function simpan($data)
    {
        require __DIR__ . '/../../config/koneksi.php';

        return mysqli_query(
            $koneksi,
            "INSERT INTO pembayaran (id_reservasi, total, metode)
             VALUES (
                '{$data['id_reservasi']}',
                '{$data['total']}',
                '{$data['metode']}'
             )"
        );
    }

    // fungsi nyata: cek status pembayaran
    public function getStatus($id_reservasi)
    {
        require __DIR__ . '/../../config/koneksi.php';

        $query = mysqli_query(
            $koneksi,
            "SELECT * FROM pembayaran WHERE id_reservasi='$id_reservasi'"
        );

        return mysqli_fetch_assoc($query);
    }
}
