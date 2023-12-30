<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ScanTiketController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Scan Tiket'
        ];

        return view('admin/scan-tiket/index', $data);
    }

    public function scan()
    {
        $tiketModel = new \App\Models\BuatTiketModel();
        $no_tiket = $this->request->getVar('no_tiket');
        $tiketEncoded = base64_decode($no_tiket);
        $tiket = $tiketModel->where('no_tiket', $tiketEncoded)->first();
        if ($tiket) {
            $data = [
                'status' => 'success',
                'data' => $tiket
            ];
        } else {
            $data = [
                'status' => 'error',
                'data' => null
            ];
        }

        return $this->response->setJSON($data);
    }
}
