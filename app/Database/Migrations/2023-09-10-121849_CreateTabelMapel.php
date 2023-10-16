<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelMapel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mapel' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_guru' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_kelas' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'mata_pelajaran' => [
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

        $this->forge->addKey('id_mapel', true);
        $this->forge->createTable('tb_mapel');
    }
    public function down()
    {
        $this->forge->dropTable('tb_mapel');
    }
}