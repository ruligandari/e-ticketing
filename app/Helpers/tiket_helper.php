<?php

use App\Models\BuatTiketModel;

function generateNoTiket()
{
    // 1. ambil tahun, bulan, tanggal
    $tahun = date('Y');
    $bulan = date('m');
    $tanggal = date('d');

    // 2. ambil urutan dari database
    $buatTiketModel = new BuatTiketModel();
    // jika data kosong, maka urutan = 0001
    $urutan = $buatTiketModel->orderBy('id', 'DESC')->first();

    if ($urutan == null) {
        $urutan = '0001';
        $noTiket = $tanggal . $bulan . $tahun  . $urutan;
    } else {
        // jika data tidak kosong, maka urutan = urutan + 1
        $urutan = $urutan['no_tiket'] + 1;
        // jika urutan < 10, maka urutan = 000$urutan
        if ($urutan < 10) {
            $urutan = '000' . $urutan;
        } else if ($urutan < 100) {
            // jika urutan < 100, maka urutan = 00$urutan
            $urutan = '00' . $urutan;
        } else if ($urutan < 1000) {
            // jika urutan < 1000, maka urutan = 0$urutan
            $urutan = '0' . $urutan;
        }
        $noTiket = $urutan;
    }
    // 3. gabungkan semua string


    return $noTiket;
}
