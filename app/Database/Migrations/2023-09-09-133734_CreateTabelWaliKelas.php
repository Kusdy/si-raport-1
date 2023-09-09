<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelWaliKelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_wali_kelas' => [
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
            'id_guru' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey('id_wali_kelas', true);
        $this->forge->createTable('tb_wali_kelas');
    }
    public function down()
    {
        $this->forge->dropTable('tb_wali_kelas');
    }
}