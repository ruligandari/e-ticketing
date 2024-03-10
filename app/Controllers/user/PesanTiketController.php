<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BuatTiketModel;
use App\Models\TiketModel;

class PesanTiketController extends BaseController
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

        $dataTiket = $tiketModel->findAll();
        $data = [
            'title' => 'Pesan Tiket',
            'dataTiket' => $dataTiket,
        ];
        return view('user/pesan-tiket/index', $data);
    }

    public function cekTiket()
    {
        $json_url = 'https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/calendar.json';
        $json = file_get_contents($json_url);

        // Mengubah JSON menjadi array asosiatif
        $data = json_decode($json, true);

        $tanggal = $this->request->getVar('tanggal');
        $tiketModel = new TiketModel();
        // ambil data $tanggal hanya hari saja
        $hari = date('l', strtotime($tanggal));
        $dateNow = date('Y-m-d', strtotime($tanggal));
        $isHoliday = '';
        $infoHariLibur = '';
        // Memeriksa apakah ada entri dengan tanggal yang cocok dengan tanggal saat ini
        if (isset($data[$dateNow])) {
            // Jika ditemukan, tampilkan informasi hari libur
            $holidayInfo = $data[$dateNow];
            // cek apakah holiday = true
            if ($holidayInfo['holiday'] == true) {
                $isHoliday = 'weekend';
                $infoHariLibur = $holidayInfo['summary'];
            } else {
                // Jika tidak ditemukan, tampilkan pesan bahwa tidak ada is$isHoliday libur
                $isHoliday = 'weekday';
            }
        } else if ($hari == 'Saturday' || $hari == 'Sunday') {
            // Jika tidak ditemukan, tampilkan pesan bahwa tidak ada hari libur
            $isHoliday = 'weekend';
            $infoHariLibur = 'Weekend';
        } else {
            $isHoliday = 'weekday';
        }
        // return ke javascript
        $data = [
            'dataTiket' => $tiketModel->where('jenis_tiket', $isHoliday)->findAll(),
            'infoHariLibur' => $infoHariLibur,
        ];
        echo json_encode($data);
    }

    public function store()
    {
        $userModel = new \App\Models\UserModel();
        $tanggal = $this->request->getVar('tanggal');
        $id = $this->request->getVar('id_tiket');
        $id_pengunjung = $this->request->getVar('id_pengunjung');
        $jumlah = $this->request->getVar('jumlah');

        // timezone Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');
        // format tanggal
        // tanggal sekarang
        $date = date('Y-m-d');
        if ($date === $tanggal) {
            // tambah 1 hari
            $tanggal = date('Y-m-d', strtotime($date . ' +1 day'));
        }
        $time = date('H:i:s');
        // gabungkan tanggal dan waktu
        $tanggal = $tanggal . $time;
        // format tanggal menjadi datetime sesuai dengan database
        $tanggal = date('Y-m-d H:i:s', strtotime($tanggal));

        $tiketModel = new TiketModel();
        $buatTiketModel = new BuatTiketModel();
        // cari tiket berdasarkan id
        $tiket = $tiketModel->find($id);
        // dapatkan nama
        $nama_tiket = $tiket['nama'];
        $harga = $tiket['harga'];
        // parse harga dan jumlah ke int
        $harga = (int) $harga;
        $jumlah = (int) $jumlah;
        // hitung total
        $total = $harga * $jumlah;

        // buat nomor tiket
        helper('tiket');
        $noTiket = generateNoTiket();
        $tanggal_pembelian = date('Y-m-d H:i:s');
        $data = [
            'no_tiket' => $noTiket,
            'nama_pemesan' => $id_pengunjung,
            'tgl_pembelian' => $tanggal_pembelian,
            'tgl_reservasi' => $tanggal,
            'status_pemesanan' => 'pending',
            'jenis_tiket' => $nama_tiket,
            'qty' => $jumlah,
            'harga_total' => $total,
            'upload_bukti' => 'belum',
        ];

        $buatTiketModel->insert($data);

        return redirect()->to(base_url('user/pesan-tiket/success/' . $noTiket));
    }

    public function success($id)
    {
        $buatTiketModel = new BuatTiketModel();

        $tiketId = $buatTiketModel->where('no_tiket', $id)->first();

        $data = [
            'title' => 'Pesanan Berhasil',
            'dataTiket' => $tiketId,
        ];

        return view('user/pesan-tiket/success', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $no_tiket = $this->request->getVar('no_tiket');
        $file = $this->request->getFile('bukti_pembayaran');
        $namaFile = $file->getRandomName();
        $file->move('uploads/bukti-pembayaran', $namaFile);

        $buatTiketModel = new BuatTiketModel();
        $data = [
            'upload_bukti' => $namaFile,
            'status_pemesanan' => 'Menunggu Konfirmasi',
        ];
        $buatTiketModel->update($id, $data);

        return redirect()->to(base_url('user/pesan-tiket/success/' . $no_tiket))->with('success', 'Bukti Pembayaran Berhasil Dikirim, Silahkan Tunggu Validasi dari Admin');
    }
}
