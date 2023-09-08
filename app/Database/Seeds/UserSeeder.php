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
            [
                'email' => 'guru@gmail.com',
                'nama' => 'Moch Syarif Hidayat, S.T',
                'password' => password_hash('guru', PASSWORD_DEFAULT),
                'role' => 'Guru'
            ],
            [
                'email' => 'siswa@gmail.com',
                'nama' => 'Ahmad Rizki, S.T',
                'password' => password_hash('siswa', PASSWORD_DEFAULT),
                'role' => 'Siswa'
            ],
            [
                'email' => 'wakel@gmail.com',
                'nama' => 'Dimas Pangestu, S.T',
                'password' => password_hash('wakel', PASSWORD_DEFAULT),
                'role' => 'Wali kelas'
            ],
            [
                'email' => 'kepsek@gmail.com',
                'nama' => 'Mbuh Keder',
                'password' => password_hash('kepsek', PASSWORD_DEFAULT),
                'role' => 'Kepala sekolah'
            ],
        ];

        $this->db->table('tb_user')->insertBatch($data);
    }
}
