<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $artikelModel = new ArtikelModel();
        $artikel = $artikelModel->orderBy('id', 'DESC')->findAll();
        $data = [
            'title' => 'Dashboard',
            'artikel' => $artikel
        ];
        return view('user/dashboard/dashboard', $data);
    }
}
