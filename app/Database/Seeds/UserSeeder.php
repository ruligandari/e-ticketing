<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama' => 'Ahmad Khoirudin',
            'email'    => 'user@gmail.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
        ];

        // Using Query Builder
        $this->db->table('tbl_user')->insert($data);
    }
}
