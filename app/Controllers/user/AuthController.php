<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function index()
    {
        // jika sudah login
        if (session()->get('user_login')) {
            return redirect()->to(base_url('user/dashboard'));
        }

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

    // registrasi

    public function registrasi()
    {
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = $this->request->getVar('password');
        $password2 = $this->request->getVar('confirm_password');

        // cek password
        if ($password != $password2) {
            session()->setFlashdata('error', 'Password tidak sama');
            return redirect()->to(base_url('user/register'))->withInput($this->request->getPost());
        }

        $data = [
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $userModel = new \App\Models\UserModel();
        $userModel->save($data);

        session()->setFlashdata('success', 'Registrasi berhasil, silahkan login');
        return redirect()->to(base_url('user'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('user'));
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
