<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BuatTiketModel;

class CetakTiket extends BaseController
{
    public function index($id)
    {
        $buatTiketModel = new BuatTiketModel();

        $tiket = $buatTiketModel->find($id);
        $data = [
            'title' => 'Cetak Tiket',
            'tiket' => $tiket,
        ];

        return view('admin/cetak/index', $data);
    }
}
