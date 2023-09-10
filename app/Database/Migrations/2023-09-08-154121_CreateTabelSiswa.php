<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_siswa' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_kelas' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_tahun_ajar' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'nis' => [
                'type' => 'INT',
                'constraint' => 20,
            ],
            'nama_siswa' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tgl_lahir' => [
                'type' => 'DATE',
            ],
            'jk' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
            ],
            'nama_ibu' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'nama_ayah' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'no_hp' => [
                'type' => 'INT',
                'constraint' => 15,
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_siswa', true);
        $this->forge->createTable('tb_siswa');
    }
    public function down()
    {
        $this->forge->dropTable('tb_siswa');
    }
}