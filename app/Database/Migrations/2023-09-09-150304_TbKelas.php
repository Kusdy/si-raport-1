<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbKelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelas' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tingkat' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'jurusan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);

        $this->forge->addKey('id_kelas', true);
        $this->forge->createTable('tb_kelas');
    }

    public function down()
    {
        $this->forge->dropTable('tb_kelas');
    }
}
