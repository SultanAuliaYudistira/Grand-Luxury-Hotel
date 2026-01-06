<?php

class Reservasi
{
    public $id_reservasi;
    public $id_user;
    public $id_kamar;
    public $tipe_kamar;
    public $tanggal_checkin;
    public $tanggal_checkout;
    public $jumlah_tamu;
    public $status;

    public function buatReservasi()
    {
        return true;
    }

    public function batalReservasi()
    {
        return true;
    }
}
