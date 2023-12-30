<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PemesananTiketController extends BaseController
{
    public function index()
    {
        $buatTiketModel = new \App\Models\BuatTiketModel();
        $data = [
            'title' => 'Pemesanan Tiket',
            'buatTiket' => $buatTiketModel->where('nama_pemesan !=', '-')->orderBy('id', 'DESC')->findAll(),
        ];

        return view('admin/pemesanan-tiket/index', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $buatTiketModel = new \App\Models\BuatTiketModel();
        $buatTiketModel->update($id, [
            'status_pemesanan' => 'Valid',
        ]);
        // return json
        $data = [
            'status' => 'success',
            'message' => 'Berhasil mengubah status pemesanan tiket',
        ];
        return $this->response->setJSON($data);
    }
}
