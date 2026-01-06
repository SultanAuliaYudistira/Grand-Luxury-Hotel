<?php

class Kamar
{
    public $id_kamar;
    public $id_tipe;
    public $tipe_kamar;
    public $harga;
    public $status;

    public function cekJadwal($checkin, $checkout)
    {
        return true;
    }
}
