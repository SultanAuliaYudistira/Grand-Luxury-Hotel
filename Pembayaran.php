<?php

class Pembayaran
{
    public $id_pembayaran;
    public $id_reservasi;
    public $metode_bayar;
    public $jumlah;
    public $status;

    public function prosesPembayaran()
    {
        return true;
    }

    public function cekStatusPembayaran()
    {
        return $this->status;
    }
}
