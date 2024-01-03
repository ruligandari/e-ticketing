<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;

class BlogController extends BaseController
{
    public function index($slug)
    {
        $artikelModel = new ArtikelModel();
        $artikel = $artikelModel->where('slug', $slug)->first();
        $data = [
            'title' => 'Informasi',
            'artikel' => $artikel
        ];

        return view('user/blog/index', $data);
    }
}
