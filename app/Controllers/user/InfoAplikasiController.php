<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class InfoAplikasiController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Info Aplikasi'
        ];

        return view('user/info-aplikasi/index', $data);
    }
}
