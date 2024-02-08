<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BuatTiketModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $buatTiketModel = new BuatTiketModel();

        $totalTiket = $buatTiketModel->countAll();
        // total pengunjung = status_pemesanan = 'valid/Valid' kemudian jumlahkan qty
        $totalPengunjung = $buatTiketModel->selectSum('qty')->where('status_pemesanan', 'valid')->first();

        $totalPendapatan = $buatTiketModel->selectSum('harga_total')->where('status_pemesanan', 'valid')->first();
        $data = [
            'title' => 'Dashboard',
            'totalTiket' => $totalTiket,
            'totalPengunjung' => $totalPengunjung['qty'] ?? '0',
            'totalPendapatan' => $totalPendapatan['harga_total'] ?? '0',
        ];
        return view('admin/dashboard/index', $data);
    }
}
