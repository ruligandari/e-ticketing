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
}
