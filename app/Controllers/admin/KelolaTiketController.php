<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TiketModel;

class KelolaTiketController extends BaseController
{
    public function index()
    {
        $tiketModel = new TiketModel();
        $data = [
            'title' => 'Kelola Tiket',
            'tiket' => $tiketModel->findAll()
        ];

        return view('admin/kelola-tiket/index', $data);
    }

    public function insert()
    {
        $tiketModel = new TiketModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'jenis_tiket' => $this->request->getPost('jenis_tiket')
        ];

        $tiketModel->insert($data);
        return redirect()->to(base_url('dashboard/kelola-tiket'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'jenis_tiket' => $this->request->getPost('jenis_tiket')
        ];
        $tiketModel = new TiketModel();

        $tiketModel->update($id, $data);
        return redirect()->to(base_url('dashboard/kelola-tiket'))->with('success', 'Data Berhasil Diedit');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        $tiketModel = new TiketModel();

        $delete = $tiketModel->delete($id);

        return $this->response->setJSON(['status' => 'success']);
    }
}
