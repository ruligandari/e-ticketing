<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AuthController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login Admin'
        ];
        return view('admin/auth/index', $data);
    }

    public function auth()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getVar('password');

        $adminModel = new AdminModel();
        $admin = $adminModel->where('username', $username)->first();

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                $data = [
                    'id' => $admin['id'],
                    'nama' => $admin['nama'],
                    'username' => $admin['username'],
                    'logged_in' => true
                ];
                session()->set($data);
                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata('error', 'Password salah');
                return redirect()->to('/');
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
