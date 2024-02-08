<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;

class ArtikelController extends BaseController
{
    public function index()
    {
        $artikelModel = new ArtikelModel();
        $data = [
            'title' => 'Informasi',
            'dataArtikel' => $artikelModel->findAll(),
        ];

        return view('admin/artikel/index', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Informasi',
        ];

        return view('admin/artikel/create', $data);
    }

    public function save()
    {
        $artikelModel = new ArtikelModel();
        $gambar = $this->request->getFile('image');
        $namaGambar = $gambar->getRandomName();
        $gambar->move('uploads/artikel', $namaGambar);
        $judul = $this->request->getVar('judul');
        $slug = url_title($judul, '-', true);
        $isi = $this->request->getVar('konten');
        // setting tanggal WIB
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d H:i:s');

        $data = [
            'judul' => $judul,
            'tanggal' => $tanggal,
            'gambar' => $namaGambar,
            'isi' => $isi,
            'slug' => $slug,
        ];

        $artikelModel->insert($data);
        session()->setFlashdata('success', 'Artikel berhasil ditambahkan');
        return redirect()->to(base_url('dashboard/artikel'));
    }

    public function show($id)
    {

        $artikelModel = new ArtikelModel();
        $data = [
            'title' => 'Informasi',
            'dataArtikel' => $artikelModel->find($id),
        ];
        return view('admin/artikel/update', $data);
    }

    public function update()
    {
        $artikelModel = new ArtikelModel();
        $id = $this->request->getVar('id');
        $judul = $this->request->getVar('judul');
        $slug = url_title($judul, '-', true);
        $isi = $this->request->getVar('konten');
        $gambar = $this->request->getFile('image');
        if ($gambar->getError()) {
            $namaGambar = $this->request->getVar('image_old');
        } else {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/artikel', $namaGambar);
        }
        // setting tanggal WIB
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d H:i:s');

        $data = [
            'judul' => $judul,
            'tanggal' => $tanggal,
            'gambar' => $namaGambar,
            'isi' => $isi,
            'slug' => $slug,
        ];

        $artikelModel->update($id, $data);
        session()->setFlashdata('success', 'Artikel berhasil diupdate');
        return redirect()->to(base_url('dashboard/artikel'));
    }

    public function delete()
    {
        $artikelModel = new ArtikelModel();
        $id = $this->request->getPost('id');
        // delete file gambar
        $dataArtikel = $artikelModel->find($id);
        unlink('uploads/artikel/' . $dataArtikel['gambar']);

        $artikelModel->delete($id);

        return json_encode([
            'status' => 'success',
            'message' => 'Artikel berhasil dihapus'
        ]);
    }
}
