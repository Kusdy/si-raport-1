<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelGuru extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_guru' => [
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
            'id_mapel' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'nip' => [
                'type' => 'INT',
                'constraint' => 20,
            ],
            'nama_guru' => [
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

        $this->forge->addKey('id_guru', true);
        $this->forge->createTable('tb_guru');
    }
    public function down()
    {
        $this->forge->dropTable('tb_guru');
    }
}