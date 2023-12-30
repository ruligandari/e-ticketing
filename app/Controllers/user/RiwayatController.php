<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class RiwayatController extends BaseController
{
    public function index()
    {
        $id = session()->get('id');
        $buatTiketModel = new \App\Models\BuatTiketModel();
        $dataBuatTiket = $buatTiketModel->where('nama_pemesan', $id)->orderBy('id', 'DESC')->findAll();
        $data = [
            'title' => 'Riwayat Pemesanan Tiket',
            'data' => $dataBuatTiket,
        ];
        return view('user/riwayat/index', $data);
    }

    public function tiket($tiket)
    {
        $buatTiketModel = new \App\Models\BuatTiketModel();
        $dataTiket = $buatTiketModel->find($tiket);
        $data = [
            'title' => 'Tiket Masuk',
            'tiket' => $dataTiket,
        ];
        return view('user/riwayat/tiket', $data);
    }
}
