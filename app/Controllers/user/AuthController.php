<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('user/auth/index', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register'
        ];
        return view('user/register/index', $data);
    }

    public function auth()
    {
        $userModel = new \App\Models\UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getVar('password');

        $user = $userModel->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'id' => $user['id'],
                    'nama' => $user['nama'],
                    'email' => $user['email'],
                    'user_login' => TRUE
                ];
                session()->set($data);
                return redirect()->to(base_url('user/dashboard'));
            } else {
                session()->setFlashdata('error', 'Password salah');
                return redirect()->to(base_url('user'));
            }
        } else {
            session()->setFlashdata('error', 'Email tidak terdaftar');
            return redirect()->to(base_url('user'));
        }
    }
}
