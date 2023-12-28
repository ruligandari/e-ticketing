<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BuatTiketModel;
use App\Models\TiketModel;

class BuatTIketController extends BaseController
{
    public function index()
    {
        $buatTiketModel = new BuatTiketModel();
        $tiketModel = new TiketModel();

        $hariIni = date('l');
        // cek hari ini weekend atau bukan
        if ($hariIni == 'Saturday' || $hariIni == 'Sunday') {
            $hari = 'weekend';
        } else {
            $hari = 'weekday';
        }

        // cari data tiket jika jenis_tiket = $hari

        $dataTiket = $tiketModel->where('jenis_tiket', $hari)->first();

        date_default_timezone_set('UTC'); // Set zona waktu ke UTC untuk mendapatkan waktu GMT
        $gmt_time = gmdate('d-m-Y H:i:s');

        // Tambahkan offset GMT+7 (7 * 3600 detik)
        $tanggalSekarang = date('d-m-Y H:i:s', strtotime($gmt_time) + 7 * 3600);

        $data = [
            'title' => 'Buat Tiket',
            'tanggal' => $tanggalSekarang,
            'tiket' => $dataTiket,
            'buatTiket' => $buatTiketModel->orderBy('id', 'DESC')->findAll(),
        ];

        return view('admin/buat-tiket/index', $data);
    }

    public function store()
    {
        helper('tiket');
        $noTiket = generateNoTiket();

        $hargaTotal = $this->request->getPost('harga_total');
        $hargaTotalConvert = str_replace('.', '', $hargaTotal);
        $qty = $this->request->getPost('qty');
        $jenisTiket = $this->request->getPost('jenis_tiket');
        $tglPembelian = $this->request->getVar('tgl_pembelian');
        // konversi tanggal dan waktu ke format database
        $tglPembelianConvert = date('Y-m-d H:i:s', strtotime($tglPembelian));
        $data = [
            'no_tiket' => $noTiket,
            'nama_pemesan' => '-',
            'jenis_tiket' => $jenisTiket,
            'tgl_pembelian' => $tglPembelianConvert,
            'status_pemesanan' => 'valid',
            'tgl_reservasi' => $tglPembelianConvert,
            'harga_total' => $hargaTotalConvert,
            'qty' => $qty,
            'upload_bukti' => '-'
        ];

        $buatTiketModel = new BuatTiketModel();
        $buatTiketModel->insert($data);

        return redirect()->to(base_url('dashboard/buat-tiket'))->with('success', 'Berhasil menambahkan data tiket');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $buatTiketModel = new BuatTiketModel();
        $buatTiketModel->delete($id);

        return redirect()->to(base_url('dashboard/buat-tiket'))->with('success', 'Berhasil menghapus data tiket');
    }
}
