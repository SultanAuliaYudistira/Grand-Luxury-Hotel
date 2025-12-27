<?php

class Reservasi
{
    // fungsi nyata: simpan reservasi
    public function simpan($data)
    {
        require __DIR__ . '/../../config/koneksi.php';

        return mysqli_query(
            $koneksi,
            "INSERT INTO reservasi (id_kamar, nama_pemesan, tanggal)
             VALUES (
                '{$data['id_kamar']}',
                '{$data['nama']}',
                '{$data['tanggal']}'
             )"
        );
    }

    // fungsi nyata: ambil reservasi terakhir
    public function getLast()
    {
        require __DIR__ . '/../../config/koneksi.php';

        $query = mysqli_query(
            $koneksi,
            "SELECT * FROM reservasi ORDER BY id_reservasi DESC LIMIT 1"
        );

        return mysqli_fetch_assoc($query);
    }
}
