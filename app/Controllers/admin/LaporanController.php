<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BuatTiketModel;

class LaporanController extends BaseController
{
    public function index()
    {
        $buatTiketModel = new BuatTiketModel();

        $data = [
            'title' => 'Laporan',
            'buatTiket' => $buatTiketModel->where('status_pemesanan <>', 'Menunggu Konfirmasi')->orderBy('id', 'DESC')->findAll(),
        ];

        return view('admin/laporan/index', $data);
    }
}
