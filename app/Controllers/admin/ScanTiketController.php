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
        try {
            $tiketEncoded = base64_decode($no_tiket);
            $tiket = $tiketModel->where('no_tiket', $tiketEncoded)->first();
            if ($tiket) {
                // cek apakah tiket valid atau tidak dari status_pemesanan
                if ($tiket['status_pemesanan'] == 'valid' || $tiket['status_pemesanan'] == 'Valid') {
                    // cek apakah telah reservasi atau belum dari field reservasi
                    if ($tiket['reservasi'] == 1) {
                        $data = [
                            'status' => 'error',
                            'data' => null,
                            'message' => 'Tiket telah di reservasi'
                        ];
                        return $this->response->setJSON($data);
                    }
                    // jika belum reservasi
                    // cek range tgl_pembelian dan tgl_reservasi dengan format DATETIME
                    $tgl_pembelian = date('Y-m-d H:i:s', strtotime($tiket['tgl_pembelian']));
                    $tgl_reservasi = date('Y-m-d H:i:s', strtotime($tiket['tgl_reservasi']));
                    $tgl_sekarang = date('Y-m-d H:i:s');

                    if ($tgl_sekarang <= $tgl_reservasi) {
                        $data = [
                            'status' => 'success',
                            'data' => $tiket
                        ];
                        // update field reservasi menjadi 1
                        $tiketModel->set('reservasi', 1)->where('no_tiket', $tiketEncoded)->update();
                        return $this->response->setJSON($data);
                    } else {
                        $data = [
                            'status' => 'error',
                            'data' => null,
                            'message' => 'Reservasi tiket pada tanggal ' . date('d F Y', strtotime($tiket['tgl_reservasi']))
                        ];
                    }
                } else {
                    $data = [
                        'status' => 'error',
                        'data' => null,
                        'message' => 'Tiket belum dibayar'
                    ];
                    return $this->response->setJSON($data);
                }
            } else {
                $data = [
                    'status' => 'error',
                    'data' => null,
                    'message' => 'Tiket tidak ditemukan'
                ];
            }

            return $this->response->setJSON($data);
        } catch (\Throwable $th) {
            $data = [
                'status' => 'error',
                'data' => null
            ];

            return $this->response->setJSON($data);
        }
    }
}
