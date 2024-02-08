<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SettingController extends BaseController
{
    public function index()
    {
        $adminModel = new \App\Models\AdminModel();
        $admin = $adminModel->where('id', session()->get('id'))->first();
        $data = [
            'title' => 'Pengaturan Akun',
            'data' => $admin,
        ];

        return view('admin/setting/index', $data);
    }

    public function update()
    {
        $id = session()->get('id');
        $adminModel = new \App\Models\AdminModel();
        $admin = $adminModel->where('id', $id)->first();
        $password = $this->request->getVar('password1');
        $password2 = $this->request->getVar('password2');
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        if ($password != $password2) {
            session()->setFlashdata('error', 'Password tidak sama');
            return redirect()->to(base_url('dashboard/setting'));
        }
        $data = [
            'nama' => $nama,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        $adminModel->update($id, $data);
        session()->setFlashdata('success', 'Berhasil mengubah data, silahkan login kembali');
        return redirect()->to(base_url('dashboard/setting'));
    }
}
