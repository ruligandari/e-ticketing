<?php

use App\Models\BuatTiketModel;

function generateNoTiket()
{
    date_default_timezone_set('Asia/Jakarta');
    // 1. Ambil tahun, bulan, tanggal
    $tahun = date('Y');
    $bulan = date('m');
    $tanggal = date('d');

    // 2. Ambil urutan dari database
    $buatTiketModel = new BuatTiketModel();
    $latestRecord = $buatTiketModel->orderBy('id', 'DESC')->first();

    if ($latestRecord == null) {
        // Jika data kosong, maka urutan = 1
        $urutan = 1;
    } else {
        // Ambil urutan dari nomor tiket terakhir
        $lastNoTiket = $latestRecord['no_tiket'];

        // Ambil nilai urutan dari nomor tiket terakhir
        $lastUrutan = (int)substr($lastNoTiket, -4);

        // Jika urutan kurang dari 9999, tambahkan 1, jika tidak, set ulang ke 1
        $urutan = ($lastUrutan < 9999) ? $lastUrutan + 1 : 1;
    }

    // Format urutan menjadi string dengan panjang 4 karakter (0001, 0010, dst.)
    $formattedUrutan = str_pad($urutan, 4, '0', STR_PAD_LEFT);

    $noTiket = $tanggal . $bulan . $tahun . $formattedUrutan;

    return $noTiket;
}
