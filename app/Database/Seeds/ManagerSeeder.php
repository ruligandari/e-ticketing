<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ManagerSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama' => 'Manager Operasional',
            'username' => 'manager',
            'password' => password_hash('manager', PASSWORD_DEFAULT),
            'role' => 2
        ];

        $this->db->table('tbl_admin')->insert($data);
    }
}
