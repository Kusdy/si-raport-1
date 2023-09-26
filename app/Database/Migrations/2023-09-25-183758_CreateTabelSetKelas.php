<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelSetKelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_set_kelas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_mapel' => [
                'type' => 'JSON',
                'null' => true
            ],
            'id_wali_kelas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey('id_set_kelas', true);
        $this->forge->createTable('tb_set_kelas');
    }

    public function down()
    {
        $this->forge->dropTable('tb_set_kelas');
    }
}