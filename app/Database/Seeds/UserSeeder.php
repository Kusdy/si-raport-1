<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email' => 'admin@gmail.com',
                'nama' => 'Administrator',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'role' => 'Admin'
            ],

            // Role selain admin, silahkan bikin akun sendiri (generate yaa)
        ];

        $this->db->table('tb_user')->insertBatch($data);
    }
}
