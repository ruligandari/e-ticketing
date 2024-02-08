<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Profile'
        ];

        return view('user/profile/index', $data);
    }
}
